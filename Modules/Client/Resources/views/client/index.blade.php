@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/assets/vendor/select2/select2.min.css" />
@endsection

@section('content')
<div class="card"> 
    <div class="row m-3">
        <div class="col-6">
            <h5 class="mt-3"><b>{{ $request->filled('search') ? 'Search results' : 'Manage Clients' }}</b></h5>
        </div>
        <div class="col-6">
            @can('create users')
            <a href="/users/create" class="btn btn-primary float-right" style="background:#757b5d"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Client</a>
            @endcan
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="border-radius: 0">
                <div class="card-body">
                    @if($users->isNotEmpty())
                        @include('users.users-table')
                    @else
                        <p>No clients found.</p>
                    @endif
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
    
@endsection

@section('scripts')

<script src="dataTables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
      $('#usersDataTable').DataTable({
        paging: false,
        ordering: true,
        info: false,
        searching: true,
        responsive: true,
      });

    });
  </script>
@endsection