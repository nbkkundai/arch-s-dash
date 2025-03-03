<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Project\Entities\Project;
use Illuminate\Routing\Controller;
use Modules\Project\Entities\Processable;
use Modules\Project\Entities\Process;
use Modules\Project\Entities\ProcessQuestionResponse;
use Modules\Project\Entities\ProcessQuestionOption;
use Auth;
use App\Models\User;
use Modules\Status\Entities\Status;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user->hasAnyPermission(['view processes'])) {
            abort(403);
        }

        $processes = Process::all();
        
        return view('project::processes.index', compact('processes'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show ($project, $processable)
    {
        $project = Project::find($project);
        $processable = Processable::findOrFail($processable);
        $process = Process::find($processable->process_id);


        $process->questions = $process->questions;
        $process->audits = $process->audits;

        foreach($process->questions as $question){
            
            $question->options =  $question->options;
      
            $question->response = ProcessQuestionResponse::where('process_id',$process->id)
                ->where('process_question_id',$question->id)
                ->where('project_id',$project->id)
                ->latest()->first();

            if ($question->type == "single_select"){
                if($question->response){
                    $question->response = ProcessQuestionOption::findOrFail($question->response->single_option_id);  
                }
            }else if ($question->type == "multi_select"){
                if($question->response){
                    // $question->response = StepQuestionResponseOption::where('step_question_response_id', $question->response->id)->get();
                    // foreach($question->response as $response_option){
                    //     $response_option->option = ProcessQuestionOption::findOrFail($response_option->step_question_option_id);  
                    // }
                }
            }else{
                if($question->response){
                 $question->response->uploads = $question->response->uploads;
                }
            }
        }

        return view('project::processes.show', compact('project','process'));
    }

    public function showProcess($id){
        $process = Process::find($id);
        $process->questions = $process->questions;

        foreach($process->questions as $question){
            
            $question->options =  $question->options;
            $question->audits = $question->audits;

            foreach($question->audits as $audit){
                $audit->user =  User::find($audit->user_id);
            }
        }

        return view('project::processes.show-process', compact('process'));
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
    public function destroy($id)
    {
        //
    }
}
