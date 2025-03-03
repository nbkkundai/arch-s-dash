@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="border-radius: 0">
                <div class="card-header">
                    
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Manage Centres</h4>
                    </div>
                    <div class="col-6">
                        <a href="/admin/centres/create" class="btn btn-primary float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Centre</a>
                        
                    </div>
                  </div>
                </div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered"  cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Province</th>
                                <th>Clients</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @foreach ($centres as $centre)
                            <tr>
                                <td>{{$centre->code}}</td>
                                <td>{{$centre->name}}</td>
                                <td>{{$centre->address_line_1}}, {{$centre->address_line_2}}, {{$centre->city}}</td>
                                <td>{{$centre->province}}</td>
                                <td>{{$centre->client_count}}</td>
                                
                                <td class="text-right">
                                    <a href="/admin/centres/{{$centre->slug}}/edit" class="btn btn-secondary btn-link edit"><i class="fa fa-pencil" style="font-size:16px"></i></a>
                                    <!-- <a href="javascript:;" class="btn btn-danger btn-link btn-sm remove"><i class="fa fa-times"></i></a> -->
                                    <a href="/admin/centres/{{$centre->slug}}" class="btn btn-info btn-link edit"><i class="fa fa-eye" style="font-size:16px"></i></a>

                                    @can('delete centres')
                                        <button data-toggle="modal" data-target="#deleteeModal{{$centre->id}}" type="button" class="btn btn-link btn-danger pull-right"><i class="fa fa-trash" style="font-size:16px"></i></button>
                                        
                                        <div class="modal fade" id="deleteeModal{{$centre->id}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <form action="/admin/centres/{{$centre->slug}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')   
                                                    <div class="modal-header">
                                                      <h5 class="modal-title text-left" id="deleteeModal{{$centre->id}}Title">Delete {{$centre->name}}</h5>
                                                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button> -->
                                                    </div>
                                                    <div class="modal-body text-left">
                                                      Are you sure you want to delete this centre?
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
                    {{$centres->links()}}
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
