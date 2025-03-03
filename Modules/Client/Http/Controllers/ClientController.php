<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Client\Entities\Client;
use Modules\Client\Entities\Group;
use Modules\Admin\Entities\Centre;
use Modules\Loan\Entities\LoanFraction;
use Modules\Loan\Entities\Loan;
use Modules\Upload\Entities\Upload;
use Modules\Client\Http\Requests\ClientStoreRequest;
use Modules\Client\Http\Requests\ClientUpdateRequest;
use Modules\Client\Entities\ClientNote;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Auth;
use App;

use Modules\Upload\Helpers\StorageHelper;

class ClientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view users'])) {
            abort(403);
        }
        
        if($request->filled('search')) {  
            $query = $request->search;

            //search the clients
            $users = User::whereHas('roles', function($q){$q->where('name', 'Client');})
                            ->where('first_name','LIKE','%'.$query."%")
                            ->orWhere('last_name','LIKE','%'.$query."%")
                            ->get();
            $is_paginated = false;

        } else {

            $users = User::whereHas('roles', function($q){$q->where('name', 'Client');})
            ->orderBy('created_at','DESC')->paginate(10);
            $is_paginated = true;
        }

        return view('client::client.index', compact('users','request','is_paginated'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create clients'])) {
            abort(403);
        }

        $client = new Client;
        $centres = Centre::all();
        $groups = Group::all();
        return view('client::client.create', compact('client','centres','groups'));
    }

    /**
     * @param \Modules\Client\Http\Requests\ClientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientStoreRequest $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create clients'])) {
            abort(403);
        }

        $loan_fractions_total=0;
        $loan_fractions =LoanFraction::all()->where('loan_id',$request->loan_id);

        foreach ($loan_fractions as $loan_fraction){
            $loan_fractions_total+=$loan_fraction->loan_amount;
        }

        $loan = Loan::findOrFail($request->loan_id);

        if($loan_fractions->count()==2){
            if($request->loan_fraction + $loan_fractions_total != $loan->loan_amount ){
                return back()->withInput($request->input())
                ->with('warning','The total of loan fractions is not adding up to the loan amount.')
                ->withErrors(['loan_fraction' => 'Expected R'.$loan->loan_amount - $loan_fractions_total.'. The total of loan fractions is not equal to the loan amount.']);
            }
        };

        if(($request->loan_fraction + $loan_fractions_total) > $loan->loan_amount )
        { 
            return back()->withInput($request->input())
                    ->with('warning','The total of loan fractions has exceeded the loan amount.')
                    ->withErrors(['loan_fraction' => 'The total of loan fractions has exceeded the loan amount.']);
        }

        $user = Auth::user();
        $client = Client::create($request->validated());

        $group = new Client();
        $client->initials =$request->initials ;
        $client->last_name =$request->last_name;
        $client->id_number =$request->id_number;
        $client->address_line_1 =$request->address_line_1;
        $client->address_line_2 =$request->address_line_2;
        $client->city =$request->city;
        $client->phone =$request->phone ;
        $client->province =$request->province;
        $client->agreed_to_privacy_policy =$request->agreed_to_privacy_policy;
        $client->save();

        $client->client_number='C'.$client->id;
        $client->creator_id = $user->id;
        $client->date_of_birth = $client->date_of_birth_from_id;
        $client->groups()->sync([$request->group_id]);

        //store centre from group
        $client->centre_id = Group::find($request->group_id)->centre_id;
        $client->save();

        //store the ID document
        if($request->hasFile('file')) {

            $file_infromation = array(
                'user'=>$user,
                'fqcn' => 'Modules\\Client\\Entities\\Client', 
                'folder_path' => '/id-documents',
                'uploadable_id' => $client->id,
                'note' => 'Client id document',
                'type' => 'ID Document',
                'is_checked' => true,
            );
   
            $upload = new Request();
            $upload->setMethod('POST');
            $upload->request->add($file_infromation);
            $upload->headers->set('content-type', 'multipart/form-data');
            $upload->files->set('file', $request->file('file'));
            (new StorageHelper)->uploadFile($upload);
        };

        //Store the loan fraction
        $loan_fraction = LoanFraction::create([           
            'client_id' => $client->id,
            'loan_id' => $request->loan_id,
            'loan_amount' => $request->loan_fraction,
        ]);
        
        //return to the group wizard
        return back()->with('success','Client created');
    }

    public function show(Request $request, Client $client)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view clients'])) {
            abort(403);
        }

        $audits = $client->audits;
        $uploads = $client->uploads;
     
        $notes = $client->client_notes;

        $red_flag=0;  $process=0;  $personal=0;

        foreach ($notes as $note){
            if($note->type=="red flag"){$red_flag+=1;}
            else if($note->type=="personal"){$personal+=1;}
            else{$process+=1;}
        }
       
        return view('client::client.show', compact('client','red_flag','process','personal','uploads','audits'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Client\Entities\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Client $client)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit clients'])) {
            abort(403);
        } 

        $uploads = $client->uploads;
        $centres = Centre::all();
        $groups = Group::all();
        
        return view('client::client.edit', compact('client','centres','groups','uploads'));
    }

    /**
     * @param \Modules\Client\Http\Requests\ClientUpdateRequest $request
     * @param \Modules\Client\Entities\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit clients'])) {
            abort(403);
        } 

        $client->update($request->validated());
        $client->groups()->sync([$request->group_id]);

        if($request->hasFile('file')) {
            
            $file_infromation = array(
                'user'=>$user,
                'fqcn' => 'Modules\\Client\\Entities\\Client', 
                'folder_path' => '/id-documents',
                'uploadable_id' => $client->id,
                'note' => 'Client id document',
                'type' => 'ID Document',
                'is_checked' => true,
            );
   
            $upload = new Request();
            $upload->setMethod('POST');
            $upload->request->add($file_infromation);
            $upload->headers->set('content-type', 'multipart/form-data');
            $upload->files->set('file', $request->file('file'));
            (new StorageHelper)->uploadFile($upload);
        }

        //go back 
        if($request->filled('referrer')) {
            return redirect($request->referrer)->with('success','Loan faction updated');
        }
        return redirect('/client/clients/'.$client->slug)->with('success','Client updated');
    }

    public function destroy(Client $client)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit clients'])) {
            abort(403);
        } 

        $client->delete();
        return redirect()->action([ClientController::class, 'index'])->with('success','client deleted');
    }
}
