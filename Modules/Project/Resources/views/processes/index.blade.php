@extends('layouts.app')

@section('content')
<div>
    <div class="card">
        <div class="m-3 row">
            <div class="col-6">
                <h5 class="mt-3"><b>Processes</b></h5>
            </div>
            <div class="col-6">
                @can('create processes')
                    <a href="/processes/create" class="btn btn-primary float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Process</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @if($processes->isNotEmpty())
                    <table id="datatable" class="table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created at</th>
                                <th width="20%" class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                    
                            @foreach ($processes as $process)
                            <tr>
                                <td>{{$process->name}}</td>
                                <td>{{$process->description}}</td>
                                
                                <td>({{Carbon\Carbon::parse($process->created_at)->diffForHumans()}})</td>
                                <td class="text-right">
                    
                                    <a href="/projects/processes/{{$process->id}}" class="btn btn-info btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>
                    
                                    @can('edit processes')
                                    <a href="/processes/{{$process->id}}/edit" class="btn btn-secondary btn-link edit"><i class="fa fa-pencil" style="font-size:16px"></i></a>
                    
                                        <button data-toggle="modal" data-target="#deleteeModal{{$process->id}}" type="button" class="btn btn-link btn-danger pull-right">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        
                                        <div class="modal fade" id="deleteeModal{{$process->id}}" tabindex="-1" role="dialog">
                                          <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <form action="/processes/{{$process->id}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                  <div class="modal-header">
                                                      <h5 class="modal-title text-left" id="exampleModalLongTitle">Delete process {{$process->name}}</h5>
                                                  </div>
                                                  <div class="modal-body text-left">
                                                      Are you sure you want to delete this process?
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
                    @else
                        <p>No processes found.</p>
                    @endif
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        responsive: true,
      });

    });
  </script>
@endsection