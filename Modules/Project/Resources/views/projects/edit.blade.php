@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/assets/vendor/select2/select2.min.css" />
@endsection

@section('content')
<div>
    <div class="card">
        <div class="m-3 row">
            <div class="col-6">
                <h5 class="mt-3"><b>Edit {{$project->name}}</b></h5>
            </div>
            <div class="col-6">
                <a href="/projects/all" class="btn btn-primary float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Back to Projects</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="col-md-12">
          <div style="border-radius: 0">
                <div class="card-header">
                <h6 class="mt-3">Project Details </h6>
                </div>
                <div class="card-body">
                    <form action="/projects" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('project::projects.partials.projects-form')
                     </form>
                </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript" src="/assets/vendor/select2/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({});
    });
</script>

@endsection