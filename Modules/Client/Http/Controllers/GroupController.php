<?php

namespace Modules\Client\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\Models\User;
use Modules\Admin\Entities\Centre;
use Modules\Status\Entities\Status;
use Modules\Client\Entities\Group;
use Modules\Loan\Entities\Loan;
use Modules\Loan\Entities\LoanFraction;
use Modules\Status\Entities\Statusable;
use Modules\Client\Entities\Client;
use Modules\Client\Http\Requests\GroupStoreRequest;
use Modules\Client\Http\Requests\GroupUpdateRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Client\Entities\ClientNote;
use Auth;
use DB;
use Carbon\Carbon;
use Log;
use Validator;

use Modules\Upload\Helpers\StorageHelper;

class GroupController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view groups'])) {
            abort(403);
        }
        
        $groups = Group::orderBy('created_at','DESC')->with('statuses')->with('centre')->paginate(10);
        $is_paginated = true;

        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');

        return view('client::group.index', compact('groups','is_paginated','statuses'));
    }

    public function show(Request $request, Group $group)
    {
        
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view groups'])) {
            abort(403);
        }
        $red_flag=0;  $process=0;  $personal=0;
     
        $clients=$group->clients;
        $is_paginated= false; //clients isn't paginated
        $uploads = $group->uploads;

        $statuses = Status::all()->where('model', 'Modules\\Loan\\Entities\\Loan');
        $loans = Loan::where('group_id', $group->id)->get();

        return view('client::group.show', compact('group','clients','uploads','is_paginated','loans','statuses'));
    }

    public function downloadMembersList(Request $request, Group $group){

        $clients=$group->clients;
        $pdf = Pdf::loadView('client::group.members-pdf', ['clients'=>$clients, 'group'=>$group]);
        return $pdf->download($group->name.' '.'MEMBERS'.'.pdf');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $centres = Centre::all()->sortBy('name');
        $group = new Group;
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');

        if($request->filled('centre_id') && $request->centre_id != '') {
            $tab = 'group';
        } else {
            $tab = 'centre';
        }

        return view('client::group.create',compact('centres','group','statuses','tab','request'));

        // return view('client::group.create',compact('centres','group','statuses'));
    }

    public function groupWizardPage1(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $centres = Centre::all()->sortBy('name');
        $group = new Group;
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');
        $loan_statuses = Status::all()->where('model', 'Modules\\Loan\\Entities\\Loan');
        $client = new Client;
        $is_paginated = false;

        $clients=new Client;
        $loan_fractions_total='';
        $loan_fractions=LoanFraction::all();
        $unallocated_amount ='';
        $loan=new Loan;

        $tab = 'centre';

        return view('client::group.create-group-wizard',compact('group','clients','loan_statuses','tab','is_paginated','loan','centres','request','statuses','client','loan_fractions_total','unallocated_amount','loan_fractions'));

    }

    public function groupWizardPage2(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $centres = Centre::all()->sortBy('name');
        $group = new Group;
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');
        $loan_statuses = Status::all()->where('model', 'Modules\\Loan\\Entities\\Loan');
        $client = new Client;
        $is_paginated = false;

        $clients=new Client;
        $loan_fractions=LoanFraction::all();
        $loan_fractions_total='';
        $unallocated_amount ='';
        $loan=new Loan;

        $tab = 'group';

        return view('client::group.create-group-wizard',compact('group','clients','tab','is_paginated','loan','centres','request','loan_statuses','statuses','client','loan_fractions_total','unallocated_amount','loan_fractions'));
        
    }

    public function groupWizardPage3(Request $request, Group $group)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $centres = Centre::all()->sortBy('name');
        $group = Group::findOrFail($request->group_id);
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');
        $loan_statuses = Status::all()->where('model', 'Modules\\Loan\\Entities\\Loan');
        $client = new Client;
        $is_paginated = false;

        $clients=new Client;
        $loan = Loan::find($request->loan_id);
        if(!$loan){
            return redirect('/client/groups/'.$group->slug.'/loan/create')->with('warning','Create a loan first');
        }


        $loan_fractions =LoanFraction::all()->where('loan_id',$loan->id);

        $loan_fractions_total = $loan_fractions->sum('loan_amount');

        $unallocated_amount = $loan->loan_amount - $loan_fractions_total;

        $tab = 'members';

        return view('client::group.create-group-wizard',compact('group','clients','tab','is_paginated','loan_statuses','loan','centres','request','statuses','client','loan_fractions_total','unallocated_amount','loan_fractions'));
        
    }

    public function groupWizardPage4(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $centres = Centre::all()->sortBy('name');

        $group = Group::findOrFail($request->group_id);
        $clients=$group->clients;
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');
        $loan_statuses = Status::all()->where('model', 'Modules\\Loan\\Entities\\Loan');
        $loan = new Loan;
   
        $is_paginated = false;
        $client=new Client;
        $loan_fractions=LoanFraction::all();
        $loan_fractions_total='';
        $unallocated_amount ='';
        
        $loan = $group->loans->last() ?? new Loan;

        if(!!$loan  && count($loan->loan_fractions) >= 3 ){
            $loan_fractions = $loan->loan_fractions;
            $loan->loan_fraction_0 = $loan_fractions[0]->loan_amount;
            $loan->loan_fraction_1 = $loan_fractions[1]->loan_amount;
            $loan->loan_fraction_2 = $loan_fractions[2]->loan_amount;
        } else {
            $loan->loan_fraction_0 = 0;
            $loan->loan_fraction_1 = 0;
            $loan->loan_fraction_2 = 0;
        }

        $tab = 'loan';

        return view('client::group.create-group-wizard',compact('group','clients','tab','loan_statuses','is_paginated','loan','centres','request','statuses','client','loan_fractions_total','unallocated_amount','loan_fractions'));
    }

    public function groupWizardPage5(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $centres = Centre::all()->sortBy('name');
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');
        $loan_statuses = Status::all()->where('model', 'Modules\\Loan\\Entities\\Loan');
        $is_paginated = false;
        $group = Group::findOrFail($request->group_id);
        $loan = Loan::findOrFail($request->loan_id);
        $client = new Client;
        $clients = $group->clients;

        $loan_fractions =LoanFraction::all()->where('loan_id',$loan->id);

        $loan_fractions_total=0;
        foreach ($loan_fractions as $loan_fraction){
            $loan_fractions_total+=$loan_fraction->loan_amount;
        }

        $unallocated_amount = $loan->loan_amount - $loan_fractions_total;

        $tab = 'confirmation';

        return view('client::group.create-group-wizard',compact('group','clients','tab','loan_statuses','is_paginated','loan','centres','request','statuses','client','loan_fractions','loan_fractions_total','unallocated_amount'));
    }

    /**
     * @param \Modules\Client\Http\Requests\GroupStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupStoreRequest $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create groups'])) {
            abort(403);
        }

        $group = new Group();
        $group->zone_name = $request->zone_name;
        $group->area_code = $request->area_code;
        $group->area_officer = $request->area_officer;
        $group->post_office = $request->post_office;
        $group->zone_code = $request->zone_code;
        $group->bank_account_name = $request->bank_account_name;
        $group->bank_account_number = $request->bank_account_number;
        $group->meeting_day = $request->meeting_day;
        $group->meeting_time = $request->meeting_time; 
        $group->centre_id = $request->centre_id; 
        $group->creator_id = $request->creator_id;
        $group->creator_id = $user->id;
        $group->name = strtoupper($request->name);
        $group->save();

        $group->group_number = 'G'.$group->id;
        $group->save();

        $group->clients()->sync($request->client_ids);

        if($request->status_id) {
            $status = Status::find($request->status_id);

            DB::table('statusables')->insert([
                'status_id'=>$status->id,
                'statusable_id'=>$group->id,
                'statusable_type'=>'Modules\Client\Entities\Group',
                'user_id' => $user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }

        if($request->hasFile('file')) {
            $file_infromation = array(
                'user'=>$user,
                'fqcn' => 'Modules\\Client\\Entities\\Group', 
                'folder_path' => '/bank-statements',
                'uploadable_id' => $group->id,
                'note' => 'Proof of bank account',
                'type' => 'Bank Statement',
                'is_checked' => true,
            );
       
            $upload = new Request();
            $upload->setMethod('POST');
            $upload->request->add($file_infromation);
            $upload->headers->set('content-type', 'multipart/form-data');
            $upload->files->set('file', $request->file('file'));
            (new StorageHelper)->uploadFile($upload);
        }

        $loan = Loan::create([   
            'loan_type' => '1',
            'disbursement_amount' => $request->loan_amount,
            'disbursement_date' => $request->disbursement_date,
            'owed_amount' => $request->loan_amount,
            'loan_amount' => $request->loan_amount,
            'group_id'=>$group->id,    
            'loan_cycle' => $request->loan_cycle,
            'loan_term' => $request->loan_term,
        ]);

        $loan->total_interest = $loan->calculated_total_interest; //Calculated attribute
        $loan->save();


        if($request->hasFile('loan_application_file')) {
            $file_infromation = array(
                'user'=>$user,
                'fqcn' => 'Modules\\Loan\\Entities\\Loan', 
                'folder_path' => '/loan-applications',
                'uploadable_id' => $loan->id,
                'note' => 'Loan application form',
                'type' => 'Loan Contract',
                'is_checked' => true,
            );
       
            $upload = new Request();
            $upload->setMethod('POST');
            $upload->request->add($file_infromation);
            $upload->headers->set('content-type', 'multipart/form-data');
            $upload->files->set('file', $request->file('loan_application_file'));
            (new StorageHelper)->uploadFile($upload);
        }

    
       $loan_status = Statusable::create([
            'status_id'=>$request->loan_status_id,
            'statusable_id'=>$loan->id,
            'statusable_type'=>'Modules\Loan\Entities\Loan',
            'user_id'=>$user->id,
        ]);

        return redirect()->action([GroupController::class,'groupWizardPage3'],['request'=>$request->all(),'group_id'=>$group->id,'loan_id'=>$loan]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Client\Entities\Group $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Group $group)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit groups'])) {
            abort(403);
        }

        $centres = Centre::all();
        $clients=$group->clients;
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');

        $uploads = $group->uploads;
        $audits = $group->audits;
        return view('client::group.edit', compact('centres','group','audits','clients','statuses','uploads'));
    }

    /**
     * @param \Modules\Client\Http\Requests\GroupUpdateRequest $request
     * @param \Modules\Client\Entities\Group $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit groups'])) {
            abort(403);
        }

        $group->update($request->validated());
        $group->group_number = 'G'.$group->id;
        $group->name = strtoupper($group->name);
        $group->save();
        $group->clients()->sync($request->client_ids);

        if($request->status_id) {
            $status = Status::find($request->status_id);

            DB::table('statusables')->insert([
                'status_id'=>$status->id,
                'statusable_id'=>$group->id,
                'statusable_type'=>'Modules\Client\Entities\Group',
                'user_id' => $user->id,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }


        if($request->hasFile('file')) {
            $file_infromation = array(
                'user'=>$user,
                'fqcn' => 'Modules\\Client\\Entities\\Group', 
                'folder_path' => '/group-forms',
                'uploadable_id' => $group->id,
                'note' => 'Group form signed by clients',
                'type' => $request->file_type,
                'is_checked' => true,
            );
       
            $upload = new Request();
            $upload->setMethod('POST');
            $upload->request->add($file_infromation);
            $upload->headers->set('content-type', 'multipart/form-data');
            $upload->files->set('file', $request->file('file'));
            (new StorageHelper)->uploadFile($upload);
        }
      
        return redirect('/client/groups/'.$group->slug)->with('success','Group updated');
    }
    
    public function destroy(Group $group)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['delete groups'])) {
            abort(403);
        }

        $group->delete();
        return redirect()->action([GroupController::class, 'index'])->with('success','group deleted');
    }
}
