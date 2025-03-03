<div class="col-md-12">
    <h5> Add group and group loan</h5>
</div>
<h6 class="mt-2">Group information</h6>
<div class="row mt-4">
    <div class="col-md-6">
        <label class="form-label">Group Name</label>
        <input name="name" type="text" class="form-control" value="{{ old('name', $group->name) }}">
        @error('name')
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
        <label class="form-label">Area Code</label>
        <input name="area_code" type="text" class="form-control" value="{{old('area_code',$group->area_code)}}">
        @error('area_code')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Area Officer</label>
        <input name="area_officer" type="text" class="form-control" value="{{old('area_code',$group->area_officer)}}"">
        @error('area_officer')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<h6 class="mt-5">Bank details</h6>
<div class="row mt-4">
    <div class="col-md-6">                                  
        <label class="form-label">Bank</label>
        
        <select name="bank_account_name" id="" class="form-control">
            @foreach(['ABSA','African Bank','Access Bank','Bidvest','Capitec Bank Limited','Discovery','First National Bank','Nedbank','Standard Bank'] as $bank_account_name)
              <option @if(old('bank_account_name') == $bank_account_name) selected @endif value="{{$bank_account_name}}">{{$bank_account_name}}</option>
            @endforeach
        </select>
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

    <div class="col-md-6 mt-4">
        <label>Use Post office as an alternative to the bank.</label><br>
        <label class="form-label">Post Office name</label>
        <input name="post_office" type="text" class="form-control" value="{{ old('post_office', $group->post_office) }}">
        @error('post_office')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mt-4">
    <div class="fileinput fileinput-new form-group col-md-6" data-provides="fileinput" >
        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
        <div>
            <span class="btn btn-secondary btn-file">
            <span class="fileinput-new">Upload Bank statement</span>
            <span class="fileinput-exists">Change</span>
                <input type="file" name="file"/>
                @error('file')
                    <span class="invalid-feedback" style="display:unset;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>
    </div>
</div>


<h6 class="mt-5">Meeting information</h6>
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

<h6 class="mt-5">Other group information</h6>
<div class="row mt-4">
    <div class="col-md-6">
        <label class="form-label">Group status</label>
        <select name="status_id" class="form-control">
          @foreach($statuses as $status)
            <option @if(old('status_id') == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
        @error('status_id')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<input type="hidden" name="centre_id" value="{{$request->centre_id}}">


<h6 class="mt-5">Loan information</h6>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="loan_cycle">Loan cycle</label>
        <input name="loan_cycle" type="number" min="0" max="12" step="1" class="form-control" value="{{ old('loan_cycle', $loan->loan_cycle) ?? 1 }}">
        @error('loan_cycle')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        <label for="loan_term">Loan term</label>
        <select name="loan_term" class="form-control">
            @foreach(['4 months','6 months','10 months'] as $loan_term)
                <option @if(old('loan_term',$loan->loan_term) == $loan_term) selected @endif value="{{$loan_term}}">{{$loan_term}}</option>
            @endforeach
        </select>
        @error('loan_term')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-row mt-10">
    <div class="form-group col-md-6">
        <label for="loan_amount">Loan amount</label>
        <input name="loan_amount" type="number" min="0" max="25000" step="500" class="form-control" value="{{ old('loan_amount', $loan->loan_amount) }}">
        @error('loan_amount')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-6">
        <label class="form-label">Loan status</label>
        <select name="loan_status_id" class="form-control">
          @foreach($loan_statuses as $status)
           <option @if(old('status_id', $loan->statuses->last()?->id) == $status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
          @endforeach
        </select>
        @error('loan_status_id')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



<div class="form-row mt-10">
    <div class="form-group col-md-6">
        <label for="disbursement_date">Disbursement date</label>
        <input name="disbursement_date" type="date" class="form-control" value="{{ old('disbursement_date', $loan->disbursement_date) ?? Carbon\Carbon::now()->format('Y-m-d') }}">
        @error('disbursement_date')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row">   
    <div class="fileinput fileinput-new form-group col-md-6" data-provides="fileinput" >
        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
        <div>
            <span class="btn btn-danger btn-file">
            <span class="fileinput-new">Upload Loan application form</span>
            <span class="fileinput-exists">Change</span>
                <input type="file" name="loan_application_file"/>
                @error('loan_application_file')
                    <span class="invalid-feedback" style="display:unset;" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </span>
        </div>
    </div>
</div>