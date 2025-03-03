<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Project\Entities\Project;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Processable;
use Modules\Project\Entities\Process;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Modules\Status\Entities\Status;
use Modules\Project\Entities\BuildingType;
use Modules\Project\Http\Requests\ProjectStoreRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view all projects'])) {
            abort(403);
        }

        $statuses = Status::all()->where('model', 'Modules\\Project\\Entities\\Project');
        $projects = Project::all();

        foreach($projects as $project){
          $project->client = $project->client;
          $project->statuses =  $project->statuses;
        }
        
        return view('project::projects.index', compact('projects','statuses'));
    }

    public function clientProjects(){
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view projects'])) {
            abort(403);
        }

        $statuses = Status::all()->where('model', 'Modules\\Project\\Entities\\Project');
        $projects = Project::where('client_id', $user->id)->get();

        foreach($projects as $project){
          $project->client = $project->client;
          $project->statuses =  $project->statuses;
        }
        
        return view('project::projects.index', compact('projects','statuses'));
    }

    public function addStatus(Request $request)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['edit projects'])) {
            abort(403);
        } 

        $status = Status::find($request->status_id);
        $project = Project::findOrFail($request->project_id);
     
        if($project->statuses->pluck('code')->max() >= 600){
          return back()->with('warning','This project has already been closed.');
        }

        //only add a status if the status is different from the existing status
        if($loan->statuses->last()?->id != $request->status_id) {
            Statusable::create([
                'status_id'=>$status->id,
                'statusable_id'=>$request->loan_id,
                'statusable_type'=>'Modules\Loan\Entities\Loan',
                'user_id'=>$user->id,
            ]);
        }

        //update loan properties for the summary table;
        $loan->refreshLoanProperties();

        return back()->with('success','loan status updated');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $user = Auth::user();

        $building_types = BuildingType::all();
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'Client');
        })->get();

        $processes = Process::all();

        return view('project::projects.create',compact('building_types','clients','processes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProjectStoreRequest $request)
    {
        $user = Auth::user();

        $new_project = Project::create($request->validated());

        foreach($request->processes as $process){
            Processable::create([
                'process_id'=>$process,
                'processable_id'=>$new_project->id,
                'processable_type'=>'Modules\\Project\\Entities\\Project',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('statusables')->insert([
            'status_id'=>Status::where('model','Modules\Project\Entities\Project')->where('name','New')->value('id'),
            'statusable_id'=>$new_project->id,
            'statusable_type'=>'Modules\Project\Entities\Project',
            'user_id' => $user->id,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ]);
       
        return back()->with('success','Project saved.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, Project $project)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view projects'])) {
            abort(403);
        }

        $uploads = $project->uploads;
        $project->client = $project->client;

        if($user->hasAnyPermission(['view all processes'])) {
            $project_processes = Processable::where('processable_id',$project->id)->get();
        }else{
            $project_processes = Processable::where('processable_id',$project->id)->where('is_active',true)->get();
        }
        

        foreach($project_processes as $process){
            $process->step = Process::findOrFail($process->process_id);
            $process->status =  $process->statuses;
        }

        $statuses = Status::all()->where('model', 'Modules\\Project\\Entities\\Processable');
       
        return view('project::projects.show', compact('project','statuses','uploads','project_processes'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Project $project)
    {
        $user = Auth::user();

        $building_types = BuildingType::all();
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'Client');
        })->get();

        $processes = Process::all();

        return view('project::projects.edit', compact('project','building_types','clients','processes'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Project $project)
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['delete projects'])) {
            abort(403);
        } 

        $project->delete();
        return redirect()->action([ProjectController::class, 'index'])->with('success','project deleted');
    }

    public function destroyProcess(Processable $processable){
        $user = Auth::user();
        if(!$user->hasAnyPermission(['delete processes'])) {
            abort(403);
        } 
        $processable->delete();
        return back()->with('success','Project step deleted');
    }
}
