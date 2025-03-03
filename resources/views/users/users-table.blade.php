<table id="usersDataTable"  class="table table-hover dataTable table-striped w-full sm-table-text" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Client Code</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($users as $user)
        <tr>
            <td>{{$user->code}}</td>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>
                <a href="" data-toggle="modal" data-target="#deactivateModal{{$user->id}}" class="mx-2 text-danger">
                    @if($user->is_active)
                        <span class="badge badge-sm badge-success">Activated</span>
                    @else
                        <span class="badge badge-sm badge-warning">Deactivated</span>
                    @endif
                </a>


                @can('activate users')
                <!--Deactivate User Modal -->
                <div class="modal fade" id="deactivateModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-left" id="exampleModalLongTitle">{{$user->is_active ? 'Deactivate' : 'Activate'}} {{$user->first_name}} {{$user->last_name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to {{$user->is_active ? 'deactivate' : 'activate'}} this client ({{$user->first_name}} {{$user->last_name}})?
                            <!-- <form action="/loan/banks/{{$user->slug}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>

                            {{-- have to implemet the backend call --}}
                            <form id="delete-form" action="/users/{{$user->slug}}/toggle-activation" method="POST">
                            @csrf
                            @method('Put')
                                @if($user->is_active)
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

                @can('edit users')
                <a href="/users/{{$user->slug}}" class="btn btn-warning btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>
                @endcan

                @can('edit users')
                <a href="/users/{{$user->slug}}/edit" class="btn btn-warning btn-link edit"><i class="fa fa-pencil" style="font-size:16px"></i></a>
                @endcan
               
                <!-- <a href="javascript:;" class="btn btn-danger btn-link btn-sm remove"><i class="fa fa-times"></i></a> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>