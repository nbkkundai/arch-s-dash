@extends('layouts.app')

@section('content')
<div>
    <div class="card">
        <div class="m-3 row">
            <div class="col-6">
                <h5 class="mt-3"><b>Project: </b> {{$project->name}}</h5>
            </div>
            <div class="col-6">
                @can('view all projects')
                    <a href="/projects/all" class="btn float-right"> Back to all projects</a>
                @endcan
                @if(Auth::user()->hasAnyRole(['Client']))
                    <a href="/projects/client-projects" class="btn float-right"> Back to all projects</a>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="card p-3">
                <div class="card-title">
                    <h6>Project details</h6>
                </div>
                <p><b>Name: </b>{{$project->name}}</p>
                <p><b>Client: </b> {{$project->client->first_name}}  {{$project->client->last_name}}</p>
                <p><b>Address: </b>{{$project->location}}</p>
                <p><b>Building type: </b></p>
            </div>
        </div>
        <div class="col-8">
            <div class="card p-3" style="min-height:200px; border-radius: 0">
                <div class="card-title">
                    <h6>Project Processes</h6>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            @can('edit processes')
                            <th>Is active</th>
                            @endcan
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project_processes as $project_process)
                        <tr>
                            <td>{{$project_process->step->name}}</td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#deactivateModal{{$project->id}}" class="mx-2 text-danger">
                                    <span class="badge badge-sm 
                                        @if($project_process->statuses->last()?->code < 300)
                                            badge-success
                                        @elseif($project_process->statuses->last()?->code >= 100)
                                            badge-danger
                                        @elseif($project_process->statuses->last()?->code >= 200)
                                            badge-warning
                                        @else
                                        badge-info
                                        @endif
                                    "
                                    >
                                    {{$project_process->status->last()?->name ?? 'None'}}</span>
                                </a>
                                <div class="modal fade" id="deactivateModal{{$project_process->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form id="delete-form" action="/projects/project/processable/status" method="POST">
                                        @csrf
                
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-left">Project: {{$project->name}} step  Status</h5>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Choose step status</label>
                                            <select name="status_id" id="status" class="form-control">
                                                @foreach($statuses as $status)
                                                  <option @if(old('status_id', $project_process->statuses->last()?->id) == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="processable_id" value="{{$project_process->id}}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary float-right mx-2" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">
                                                Update status
                                            </button>
                                        </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#deactivateProcessModal{{$project_process->id}}" class="mx-2 text-danger">
                                    @if($project_process->is_active)
                                        <span class="badge badge-sm badge-success">Activated</span>
                                    @else
                                        <span class="badge badge-sm badge-warning">Deactivated</span>
                                    @endif
                                </a>


                                @can('edit processes')
                                <div class="modal fade" id="deactivateProcessModal{{$project_process->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-left" id="exampleModalLongTitle">{{$project_process->is_active ? 'Deactivate' : 'Activate'}} {{$project_process->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to {{$project_process->is_active ? 'deactivate' : 'activate'}} this process ({{$project_process->name}})?
                                            <!-- <form action="/loan/banks/{{$project_process->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form> -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>

                                            {{-- have to implemet the backend call --}}
                                            <form id="delete-form" action="/users/{{$project_process->id}}/toggle-activation" method="POST">
                                            @csrf
                                            @method('Put')
                                                @if($project_process->is_active)
                                                    <button type="submit" class="btn btn-warning">
                                                        Deactivate
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success">
                                                        Activate
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan
                            </td>
                            <td class="text-right">
                                <a href="/projects/{{$project->id}}/processes/{{$project_process->id}}" class="btn btn-info btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>
                
                                @can('delete projects')
                                    <button data-toggle="modal" data-target="#deleteeModal{{$project_process->id}}" type="button" class="btn btn-link btn-danger pull-right">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    
                                    <div class="modal fade" id="deleteeModal{{$project_process->id}}" tabindex="-1" role="dialog">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <form action="/projects/processes/{{$project_process->id}}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <div class="modal-header">
                                                  <h5 class="modal-title text-left" id="exampleModalLongTitle">Delete stage</h5>
                                              </div>
                                              <div class="modal-body text-left">
                                                  Are you sure you want to delete this stage?
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">No, cancel</button>
                                                  <button type="submit" class="btn btn-danger ml-auto">Yes, delete</button>
                                              </div>
                
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
