
    <!-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison -->
    <div data-toggle="modal" data-target="#notesModal{{$client->id}}" type="button">

        <!-- open modal with all the notes -->

        @if($redflags->isNotEmpty())
                
            <i class="fa fa-flag" style="color:red;"></i>
            <sup style="top: -1em; left: -0.5em; position: relative; font-size: 100%; line-height: 0; vertical-align: baseline;">
                <span class="badge badge-pill" style="color:red;">{{$redflags->count()}}</span>
            </sup>

        @endif

        @if($process->isNotEmpty())
            <i class="fa fa-arrow-circle-right" style="color:green;"></i>
            <sup style="top: -1em; left: -0.5em; position: relative; font-size: 100%; line-height: 0; vertical-align: baseline;">
                <span class="badge badge-pill" style="color:green;">{{$process->count()}}</span>
            </sup>
        @endif

        @if($personal->isNotEmpty())
            <i class="fa fa-user" style="color:black"></i>
            <sup style="top: -1em; left: -0.5em; position: relative; font-size: 100%; line-height: 0; vertical-align: baseline;">
                <span class="badge badge-pill" style="color:black">{{$personal->count()}}</span>
            </sup>
        @endif

        @if($client->client_notes->isEmpty())
        <i class="fa fa-pencil-square-o" style="font-size:16px"></i>
        @endif

    </div>
    <div class="modal fade" id="notesModal{{$client->id}}" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-left">Notes for {{$client->initials}} {{$client->last_name}}</h5>
              </div>
              <div class="modal-body text-left">

                @if($client->client_notes->isNotEmpty())
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Comment</th>
                            <th>Written by</th>
                            <th>Date</th>
                            @can('delete notes')
                            <th class="disabled-sorting text-right">Actions</th> 
                            @endcan
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($client->client_notes as $client_note)
                        <tr>
                            <td>{{$client_note->type}}</td>
                            <td>{{$client_note->text}}</td>
                            <td>{{$client_note->user?->full_name}}</td>
                            <td>
                                {{$client_note->created_at}}
                                <br>
                                <small>({{Carbon\Carbon::parse($client_note->created_at)->diffForHumans()}})</small>
                            </td>
                            
                            @can('delete notes')
                            <td class="text-right">
                                <button data-toggle="modal" data-target="#deleteModal{{$client_note->id}}" type="button" class="btn btn-link btn-danger pull-right"><i class="fa fa-trash" style="font-size:16px"></i></button>
                                
                                <div class="modal fade" id="deleteModal{{$client_note->id}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                          <form action="/client/client-notes/{{$client_note->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')   
                                            <div class="modal-header">
                                              <h5 class="modal-title text-left" id="deleteeModal{{$client_note->id}}Title">Delete</h5>
                                            </div>
                                            <div class="modal-body text-left">
                                              Are you sure you want to delete this note?
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">No, cancel</button>
                                              <button type="submit" class="btn btn-danger ml-auto">Yes, delete</button>
                                            </div>
                                          </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br><br><br>
                @endif

                <form action="/client/client-notes" method="POST">
                  @csrf
                    <h5 class="modal-title text-left mt-10">Add a note</h5>
                    <div class="form-group">
                      <label>Select the type of note</label>
                      <select name="type" class="form-control">
                        <option value="personal">Personal</option>
                        <option value="process">Process</option>
                        <option value="red flag">Red flag</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Write a comment</label>
                      <textarea name="text" class="form-control" rows="3"></textarea>
                      <input name="client_id" type="text" class="form-control" value="{{$client->id}}" hidden>
                    </div>
                    <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success float-right">Save</button>
                </form>
              </div>
          </div>
      </div>
    </div>