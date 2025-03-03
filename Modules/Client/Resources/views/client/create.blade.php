@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10">
          <div class="card" style="border-radius: 0">
            <div class="card-header card-header-icon card-header-rose">
              <h4 class="card-title">Add Client
              </h4>
            </div>
            <div class="card-body">
              
                <form action="/client/clients" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                @include('client::client.partials.clients-form')

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Centre</label>
                    <select name="centre_id" class="form-control">
                        @foreach($centres as $centre)
                          <option @if(old('centre_id') == $centre->id) selected @endif value="{{$centre->id}}">{{$centre->code}} {{$centre->name}}</option>
                        @endforeach
                    </select>
                    @error('centre_id')
                        <span class="invalid-feedback" style="display:unset;" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                    <div class="form-group col-md-6">
                        <label>Group</label>
                        <select name="group_id" class="form-control">
                            <option value="">Select group</option>
                            @foreach($groups as $group)
                              <option @if(old('group_id') == $group->id) selected @endif value="{{$group->id}}">{{$group->code}} {{$group->name}}</option>
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
                        <a href="/client/clients" class="btn btn-secondary">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Save</button>
                      <div class="clearfix"></div>
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
@endpush