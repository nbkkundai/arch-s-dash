@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="border-radius: 0">
                <div class="card-header">
                    
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Manage Groups</h4>
                    </div>
                    <div class="col-6">
                        <a href="/client/groups/group-wizard-page-1" class="btn btn-primary float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Group</a>
                    </div>
                  </div>

                </div>
                <div class="card-body">
                    @include('client::group.partials.groups-table')
                </div><!-- end content-->
            </div><!--  end card  -->
        </div> <!-- end col-md-12 -->
    </div> <!-- end row -->

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
