@extends('layouts.app')

@section('content')
<div class="container">
          <div class="card" style="border-radius: 0">
              <div class="card-header card-header-icon card-header-rose">
                <div class="row">
                  <div class="col-md-8">
                    <h4 class="card-title">Client Profile</h4>
                  </div>
                  <div class="col-md-4">                  

                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="/client/clients/{{$client->slug}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  @include('client::client.partials.clients-form')
                  
                  <div class="form-row" id="formBody">

                    <div class="form-group col-md-4">
                      <label for="inputEmail4">Centre</label>
                      <select name="centre_id" class="form-control">
                          @foreach($centres as $centre)
                            <option @if(old('centre_id', $client->centre_id) == $centre->id) selected @endif value="{{$centre->id}}">{{$centre->code}} {{$centre->name}}</option>
                          @endforeach
                      </select>
                      @error('centre_id')
                          <span class="invalid-feedback" style="display:unset;" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                      <div class="form-group col-md-4">
                          <label>Group</label>
                          <select name="group_id" class="form-control">
                              <option value="">Select group</option>
                              @foreach($groups as $group)
                                <option @if(old('group_id',$client->groups->last()?->id) == $group->id) selected @endif value="{{$group->id}}">{{$group->code}} {{$group->name}}</option>
                              @endforeach
                          </select>
                          @error('group_id')
                              <span class="invalid-feedback" style="display:unset;" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <a onclick="history.back()"  class="btn btn-secondary text-white">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Update client</button>
                    </div>
                  </div>
                </form>
              </div>
          </div>
          <div class="card p-3" style="border-radius: 0"> @include('upload::show-uploads')</div>
</div>

@endsection
@section('scripts')
<!-- add route back to the previous page -->
<script type="text/javascript">
    var referrer = document.referrer;
    $(document).ready(function() {
        $('#formBody').append('<input type="hidden" name="referrer" value="' + referrer + '">');    
    });
</script>

<script type="text/javascript">
$('.datetimepicker').datetimepicker({
              format: 'DD-MM-YYYY',
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
@endsection
