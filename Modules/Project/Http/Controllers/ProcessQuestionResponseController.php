<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Upload\Helpers\StorageHelper;
use Modules\Project\Entities\Process;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProcessQuestion;
use Modules\Project\Entities\ProcessQuestionResponse;
use Auth;

class ProcessQuestionResponseController extends Controller
{
    public function store(Request $request, $project, $process, $question)
    {   
        $user = Auth::user();

        $response = new ProcessQuestionResponse();
        $response->project_id = $project;
        $response->process_id = $process;
        $response->process_question_id = $question;
        $response->text_answer = $request->text_answer;
        $response->single_option_id =  $request->single_option_id;
        $response->save();

        if($request->hasFile('document')) {
            $file_infromation = array(
                'user'=>$user, 
                'fqcn' => 'Modules\\Project\\Entities\\ProcessQuestionResponse', 
                'folder_path' => '/documents',
                'uploadable_id' => $response->id,
                'note' => 'Document',
                'type' => 'Document',
                'is_checked' => true,
            );
        
            $upload = new Request();
            $upload->setMethod('POST');
            $upload->request->add($file_infromation);
            $upload->headers->set('content-type', 'multipart/form-data');
            $upload->files->set('file', $request->file('document'));
            (new StorageHelper)->uploadFile($upload);
        }
        
        return redirect('/projects/'.$project.'/processes/'.$process)->with('success','Response saved');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('project::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('project::edit');
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
