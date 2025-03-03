<table id="projectsDataTable" class="table table-hover dataTable table-striped w-full sm-table-text" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Client</th>
            <th>Created at</th>
            <th>Status</th>
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>
   
    <tbody>

        @foreach ($projects as $project)
        <tr>
            <td>{{$project->name}}</td>
            <td>{{$project->location}}</td>
            <td>{{$project->client->first_name}} {{$project->client->last_name}}</td>
            <td>({{Carbon\Carbon::parse($project->created_at)->diffForHumans()}})</td>
   
            <td>
               
                <a href="" data-toggle="modal" data-target="#deactivateModal{{$project->id}}" class="mx-2 text-danger">
                    <span class="badge badge-sm 
                        @if($project->statuses->last()?->code < 300)
                            badge-success
                        @elseif($project->statuses->last()?->code >= 100)
                            badge-danger
                        @elseif($project->statuses->last()?->code >= 200)
                            badge-warning
                        @else
                        badge-info
                        @endif
                    "
                    >
                    {{$project->statuses->last()?->name ?? 'None'}}</span>
                </a>

                @can('edit projects')
                <div class="modal fade" id="deactivateModal{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="delete-form" action="/loan/loans/status" method="POST">
                        @csrf

                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-left">Project: {{$project->name}} STATUS</h5>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Choose Project status</label>
                            <select name="status_id" id="status" class="form-control">
                                @foreach($statuses as $status)
                                  <option @if(old('status_id', $project->statuses->last()?->id) == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="loan_id" value="{{$project->id}}">
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
                @endcan
            </td>
            <td class="text-right">

                <a href="/projects/{{$project->id}}" class="btn btn-info btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>

                @can('edit projects')
                <a href="/projects/{{$project->id}}/edit" class="btn btn-secondary btn-link edit"><i class="fa fa-pencil" style="font-size:16px"></i></a>

                    <button data-toggle="modal" data-target="#deleteeModal{{$project->id}}" type="button" class="btn btn-link btn-danger pull-right">
                        <i class="fa fa-trash"></i>
                    </button>
                    
                    <div class="modal fade" id="deleteeModal{{$project->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <form action="/projects/{{$project->id}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <div class="modal-header">
                                  <h5 class="modal-title text-left" id="exampleModalLongTitle">Delete project {{$project->name}}</h5>
                              </div>
                              <div class="modal-body text-left">
                                  Are you sure you want to delete this project?
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