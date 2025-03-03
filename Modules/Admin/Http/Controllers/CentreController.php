<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Client\Entities\Client;
use Modules\Admin\Entities\Centre;
use Modules\Admin\Http\Requests\CentreStoreRequest;
use Modules\Admin\Http\Requests\CentreUpdateRequest;
use Auth;
use Modules\Status\Entities\Status;

class CentreController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view centres'])) {
            abort(403);
        }

        $centres = Centre::orderBy('name','ASC')->paginate(10);

        return view('admin::centre.index', compact('centres'));
    }

    public function show(Request $request, Centre $centre)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view centres'])) {
            abort(403);
        }

        $groups = $centre->groups;
        $clients = Client::where('centre_id',$centre->id)->get();
       
        $is_paginated = false;
        $statuses = Status::all()->where('model', 'Modules\\Client\\Entities\\Group');

        return view('admin::centre.show', compact('centre','groups','is_paginated','statuses','clients'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create centres'])) {
            abort(403);
        }

        $centre = new Centre;
        return view('admin::centre.create',compact('centre'));
    }

    /**
     * @param \Modules\Admin\Http\Requests\CentreStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CentreStoreRequest $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['create centres'])) {
            abort(403);
        }

        $centre = Centre::create($request->validated());

        $centre->creator_id = $user->id;
        $centre->name = strtoupper($request->name);
        $centre->save();

        //redirect to group creation form, since this is normally the next step after creating a group
        return redirect('/admin/centres')->with('success','Centre created.');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Modules\Admin\Entities\Centre $centre
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Centre $centre)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit centres'])) {
            abort(403);
        }
        $audits = $centre->audits;

        return view('admin::centre.edit', compact('centre','audits'));
    }

    /**
     * @param \Modules\Admin\Http\Requests\CentreUpdateRequest $request
     * @param \Modules\Admin\Entities\Centre $centre
     * @return \Illuminate\Http\Response
     */
    public function update(CentreStoreRequest $request, Centre $centre)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit centres'])) {
            abort(403);
        }

        $centre->update($request->validated());
        $centre->name = strtoupper($centre->name);
        $centre->save();
        return redirect()->action([CentreController::class, 'index']);
    }

    public function destroy(Centre $centre)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['delete centres'])) {
            abort(403);
        }
        
        $centre->delete();
        return redirect()->action([CentreController::class, 'index'])->with('success','Centre deleted');
    }
}
