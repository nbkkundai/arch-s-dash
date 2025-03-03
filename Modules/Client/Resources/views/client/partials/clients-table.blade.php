<table id="clientssDataTable" class="table table-hover dataTable table-striped w-full sm-table-text" width="100%">
    <thead>
        <tr>
            <th>Member Number</th>
            <th>Name</th>
            <th>ID Number</th>
            <th>Centre</th>
            <th>Group</th>
            <th>Created at</th>
            <th>Notes</th>
            <th class="disabled-sorting text-right">Actions</th>
        </tr>
    </thead>
   
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{$client->client_number}}</td>
            <td>{{$client->initials}} {{$client->last_name}}</td>
            <td>{{$client->id_number}}</td>
            <td>{{$client->centre?->name}}</td>
            <td>
                <a href="/client/groups/{{$client->groups->first()?->slug}}">
                    {{$client->groups->first()?->name}}
                </a>

            </td>

            <td>
                {{Carbon\Carbon::parse($client->created_at)->format('Y-m-d')}}
                <br>
                <small>({{Carbon\Carbon::parse($client->created_at)->diffForHumans()}})</small>
            </td>

            <td class="text-center pt-4">
              <x-notes :client="$client" :process="$client->client_notes->where('type','process')" :redflags="$client->client_notes->where('type','red flag')" :personal="$client->client_notes->where('type','personal')" />
            </td>
            
            <td class="text-right">
           
                <a href="/client/clients/{{$client->slug}}" class="btn btn-info btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>
                
                <a href="/client/clients/{{$client->slug}}/edit" class="btn btn-secondary btn-link edit"><i class="fa fa-pencil" style="font-size:16px"></i></a>

                @can('delete clients')
                    <button data-toggle="modal" data-target="#deleteeModal{{$client->id}}" type="button" class="btn btn-link btn-danger pull-right"><i class="fa fa-trash" style="font-size:16px"></i></button>
                    
                    <div class="modal fade" id="deleteeModal{{$client->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <form action="/client/clients/{{$client->slug}}" method="POST">
                                @csrf
                                @method('DELETE')   
                                <div class="modal-header">
                                  <h5 class="modal-title text-left" id="deleteeModal{{$client->id}}Title">Delete {{$client->name}}</h5>
                                 
                                </div>
                                <div class="modal-body text-left">
                                  Are you sure you want to delete this client?
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
  {{$clients->links()}}
@endif