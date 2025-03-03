@extends('layouts.app')

@section('css')
<link href="/assets/vendor/select2/css/select2.css" rel="stylesheet"/>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
          <div class="card" style="border-radius: 0">
              <div class="card-header card-header-icon card-header-rose">
                <div class="row">
                  <div class="col-md-8">
                    <h4 class="card-title">Edit Centre</h4>
                  </div>
                  <div class="col-md-4">   
                    <!--  -->
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="/admin/centres/{{$centre->slug}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  @include('admin::centre.partials.centre-form')
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <a class="btn btn-secondary" href="/admin/centres">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Update Centre</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="/assets/vendor/select2/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            theme: "classic"
        });
    });
</script>

@endpush