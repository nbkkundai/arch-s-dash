@extends('layouts.app')
@section('css')
<link rel="stylesheet"  href="dataTables/jquery.dataTables.css">
@endsection
@section('content')
<div>
    <div class="card">
        <div class="m-3 row">
            <div class="col-6">
                <h5 class="mt-3"><b>Projects</b></h5>
            </div>
            <div class="col-6">
                @can('create projects')
                    <a href="/projects/create" class="btn btn-primary float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Project</a>
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
                    @if($projects->isNotEmpty())
                        @include('project::projects.partials.projects-table')
                    @else
                        <p>No Projects found.</p>
                    @endif
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->
</div>
@endsection


@section('scripts')

<script src="dataTables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
      $('#projectsDataTable').DataTable({
        paging: false,
        ordering: true,
        info: false,
        searching: true,
        responsive: true,
      });

    });
  </script>
@endsection