<table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Group Number: Name</th>
            <th>Serial number</th>
            <th>Centre Code: Name</th>
            <th>Area Officer</th>
            <th>Status</th>
            <th>Created at</th>
            <th width="20%" class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>
   
    <tbody>

        @foreach ($groups as $group)
        <tr>
            <td>{{$group->group_number ? $group->group_number.':' : ''}} {{$group->name}}</td>
            <td>{{$group->id}}</td>
            <td>{{$group->centre?->code ? $group->centre?->code.':' : ''}} {{$group->centre?->name}}</td>
            <td>{{$group->area_officer}}</td>
            <td>
                <a href="" data-toggle="modal" data-target="#deactivateModal{{$group->id}}" class="mx-2 text-danger">
                    <span class="badge badge-sm 
                        @if($group->statuses->last()?->name == 'New')
                            badge-success
                        @elseif($group->statuses->last()?->name == 'Defaulted')
                            badge-danger
                        @elseif($group->statuses->last()?->name == 'Inactive')
                            badge-warning
                        @else
                            badge-info
                        @endif
                    "
                    >{{$group->statuses->last()?->name ?? 'None'}}</span>
                </a>

                {{-- @can('activate groups') --}}
                <!--group status Modal -->
                <div class="modal fade" id="deactivateModal{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form id="delete-form" action="/client/groups/{{$group->slug}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-left">{{$group->name}} STATUS</h5>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Choose group status</label>
                            <select name="status_id" id="status" class="form-control">
                                @foreach($statuses as $status)
                                  <option @if(old('status_id', $group->statuses->last()?->id) == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-left mx-2" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-warning">
                                Update status
                            </button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
                {{-- @endcan --}}
            </td>
            
            <td>
                {{Carbon\Carbon::parse($group->created_at)->format('Y-m-d')}}
                <br>
                <small>({{Carbon\Carbon::parse($group->created_at)->diffForHumans()}})</small>
            </td>

            <td class="text-right">

                <!-- Note this function can be removed later to improve page speed -->
                @if($group->member_count < 3)
                <a href="/client/groups/group-wizard-page-3?centre_id={{$group->centre_id}}&group_id={{$group->id}}" class="btn btn-secondary btn-link edit"><i class="fa fa-user-plus" style="font-size:16px"></i></a>
                @endif

                <a href="/client/groups/{{$group->slug}}/edit" class="btn btn-secondary btn-link edit"><i class="fa fa-pencil" style="font-size:16px"></i></a>
                <a href="/client/groups/{{$group->slug}}" class="btn btn-info btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>

                @can('delete groups')
                    <button data-toggle="modal" data-target="#deleteeModal{{$group->id}}" type="button" class="btn btn-link btn-danger pull-right">
                        <i class="fa fa-trash"></i>
                    </button>
                    
                    <div class="modal fade" id="deleteeModal{{$group->id}}" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <form action="/client/groups/{{$group->slug}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <div class="modal-header">
                                  <h5 class="modal-title text-left" id="exampleModalLongTitle">Delete {{$group->name}}</h5>
                                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                  </button> -->
                              </div>
                              <div class="modal-body text-left">
                                  Are you sure you want to delete this group?
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

@if($is_paginated)
    {{$groups->links()}}
@endif