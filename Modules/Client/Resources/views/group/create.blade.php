@extends('layouts.app')

@section('css')
<link href="/assets/vendor/select2/css/select2.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10">
          <form action="/client/groups" method="POST" enctype="multipart/form-data">
            @csrf
            @include('client::group.partials.group-form')

            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="/client/groups" class="btn btn-secondary">Back</a>
                  <button type="submit" class="btn btn-success pull-right">Save</button>
                  <div class="clearfix"></div>
                </div>
            </div>
           
          </form>
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

<script>
  $('.datetimepicker').datetimepicker({
    icons: {
      time: "fa fa-clock-o",
      date: "fa fa-calendar",
      up: "fa fa-chevron-up",
      down: "fa fa-chevron-down",
      previous: 'fa fa-chevron-left',
      next: 'fa fa-chevron-right',
      today: 'fa fa-screenshot',
      clear: 'fa fa-trash',
      close: 'fa fa-remove'
    }
});
</script>

@endpush