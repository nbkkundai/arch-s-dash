<div class="row mt-4">
    <div class="col-md-6">
      
        <label class="form-label">Name</label>
        <input name="name" type="text" class="form-control" value="{{ old('name', $group->name) }}">
        @error('name')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class=" col-md-6">
        <label>Group number</label>
        <input disabled name="group_number" type="text" maxlength="13" maxlength="13" class="form-control" value="{{ old('group_number', $group->group_number) }}">
        @error('group_number')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6">
      
        <label class="form-label">Area code</label>
        <input name="area_code" type="text" class="form-control" value="{{ old('area_code', $group->area_code) }}">
        @error('area_code')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class=" col-md-6">
        <label>Area officer</label>
        <input disabled name="area_officer" type="text" maxlength="13" maxlength="13" class="form-control" value="{{ old('area_officer', $group->area_officer) }}">
        @error('area_officer')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>

  <div class="row mt-4">

    <div class="col-md-6">
      
        <label class="form-label">Zone name</label>
        <input name="zone_name" type="text" class="form-control" value="{{ old('zone_name', $group->zone_name) }}">
        @error('zone_name')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>

    <div class="col-md-6">
      
        <label class="form-label">Zone code</label>
        <input name="zone_code" type="text" class="form-control" value="{{ old('zone_code', $group->zone_code) }}">
        @error('zone_code')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>

  <div class="row mt-4">

    <div class="col-md-6">
      
        <label class="form-label">Bank</label>
        <input name="bank_account_name" type="text" class="form-control" value="{{ old('bank_account_name', $group->bank_account_name) }}">
        @error('bank_account_name')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>

    <div class="col-md-6">
      
        <label class="form-label">Bank account number</label>
        <input name="bank_account_number" type="text" class="form-control" value="{{ old('bank_account_number', $group->bank_account_number) }}">
        @error('bank_account_number')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>

  <div class="row mt-4">

    <div class="col-md-6">
      
        <label class="form-label">Meeting day</label>
        <select name="meeting_day" id="" class="form-control">
            @foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $meeting_day)
              <option @if(old('meeting_day') == $meeting_day) selected @endif value="{{$meeting_day}}">{{$meeting_day}}</option>
            @endforeach
        </select>
        @error('meeting_day')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>

    <div class="col-md-6">
      
        <label class="form-label">Meeting time</label>
        <select name="meeting_time" id="" class="form-control">
            @foreach(['8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'] as $meeting_time)
              <option @if(old('meeting_time') == $meeting_time) selected @endif value="{{$meeting_time}}">{{$meeting_time}}</option>
            @endforeach
        </select>
          @error('meeting_time')
              <span class="invalid-feedback" style="display:unset;" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
    </div>
  </div>

  <div class="row mt-4">

    <div class="col-md-6">
        <label class="form-label">Centre</label>
        <select name="centre_id" id="" class="form-control">
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

    <div class="col-md-6">
        <label class="form-label">Post Office</label>
        <input name="post_office" type="text" class="form-control" value="{{ old('post_office', $group->post_office) }}">
        @error('post_office')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>

  <div class="row mt-4">

    <div class="col-md-6">
        <label class="form-label">Statuses</label>
        <select name="status_id" class="form-control">
          @foreach($statuses as $status)
            <option @if(old('status_id', $group->statuses->last()?->id) == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
        @error('status_id')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Loan term </label>
        <select name="loan_term" id="" class="form-control">
            @foreach(['4 months','6 months'] as $loan_term)
              <option @if(old('loan_term') == $loan_term) selected @endif value="{{$loan_term}}">{{$loan_term}}</option>
            @endforeach
        </select>
        @error('loan_term')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
  </div>