@extends('layouts.app')

@section('css')
<link href="/assets/vendor/select2/css/select2.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
          <div class="card" style="border-radius: 0">
              <div class="card-header card-header-icon card-header-rose">
                <div class="row">
                  <div class="col-md-8">
                    <h4 class="card-title">Group Profile</h4>
                  </div>
                  <div class="col-md-4">                  
                    <!--  -->
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="/client/groups/{{$group->slug}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  @include('client::group.partials.group-form')
                  <div class="row mt-4">
                    <div class="fileinput fileinput-new form-group col-md-6" data-provides="fileinput" >
                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                        <div>
                            <span class="btn btn-default btn-file">
                            <span class="fileinput-new">Upload a file</span>
                            <span class="fileinput-exists">Change</span>
                                <input type="file" name="file"/>
                                @error('file')
                                    <span class="invalid-feedback" style="display:unset;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </span>
                        </div>
                        <div class="fileinput-exists">
                          <label class="form-label">Select file type</label>
                          <select name="file_type" class="form-control">
                              @foreach(['Group Form','Bank Statement'] as $file_type)
                                <option value="{{$file_type}}">{{$file_type}}</option>
                              @endforeach
                          </select>
                        </div>
                        @error('file_type')
                        <span class="invalid-feedback" style="display:unset;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <a href="/client/groups" class="btn btn-secondary">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Update Group</button>
                    </div>
                  </div>
                </form>
              </div>
    </div>
    <div class="card p-3" style="border-radius: 0"> 
      @include('upload::show-uploads')
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