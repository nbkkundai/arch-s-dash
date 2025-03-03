  <h6 class="mt-2">Personal information</h6>
  <div>
    {{--
    <div class="form-row">
        <!-- <div class="form-group col-md-3">
            <label for="inputEmail4">Code</label>
            <input name="code" type="text" class="form-control" value="{{ old('code', $client->code) }}">
            @error('code')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> -->
        <div class="form-group col-md-3">
            <label for="inputPassword4">Member number</label>
            <input disabled name="client_number" type="text" maxlength="13" maxlength="13" class="form-control" value="{{ old('client_number', $client->client_number) }}">
            @error('client_number')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    --}}

    <div class="form-row">
      {{-- <div class="form-group col-md-4">
        <label for="inputEmail4">First name</label>
        <input name="first_name" type="text" class="form-control" value="{{ old('first_name', $client->first_name) }}">
        @error('first_name')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div> --}}
      <div class="form-group col-md-2">
        <label for="inputEmail4">Initials</label>
        <input name="initials" type="text" class="form-control" value="{{ old('initials', $client->initials) }}">
        @error('initials')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>

      <div class="form-group col-md-4">
        <label for="inputPassword4">Last name</label>
        <input name="last_name" type="text" class="form-control" value="{{ old('last_name', $client->last_name) }}">
        @error('last_name')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">ID number</label>
            <input name="id_number" type="text" maxlength="13" maxlength="13" class="form-control" value="{{ old('id_number', $client->id_number) }}">
            @error('id_number')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- <div class="form-group col-md-2">
            <label for="inputZip">Marital status</label>
            <select name="marital_status" class="form-control">
                @foreach(['','Married','Single','Divorced'] as $marital_status)
                  <option @if(old('marital_status') == $marital_status) selected @endif value="{{$marital_status}}">{{$marital_status}}</option>
                @endforeach
            </select>
            @error('marital_status')
              <span class="invalid-feedback" style="display:unset;" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div> --}}
    </div>
    
    <div class="form-row">
        <div class="fileinput fileinput-new form-group col-md-6" data-provides="fileinput" >
            <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
            <div>
                <span class="btn btn-secondary btn-file">
                <span class="fileinput-new">Upload ID file</span>
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

    <h6 class="mt-2">Contact information</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputAddress">Phone number</label>
            <input name="phone" type="text" class="form-control" value="{{ old('phone', $client->phone) }}">
            @error('phone')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="address_line_1">Address line 1</label>
            <input name="address_line_1" type="text" class="form-control" value="{{ old('address_line_1', $client->address_line_1) }}">
              @error('address_line_1')
                  <span class="invalid-feedback" style="display:unset;" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="address_line_2">Address line 2</label>
            <input name="address_line_2" type="text" class="form-control" value="{{ old('address_line_2', $client->address_line_2) }}">
              @error('address_line_2')
                  <span class="invalid-feedback" style="display:unset;" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="city">City / Town / Township</label>
            <input name="city" type="text" class="form-control" value="{{ old('city', $client->city) }}">
            @error('city')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Province</label>
            <select name="province" id="" class="form-control">
              @foreach(['KwaZulu-Natal','Eastern Cape','Free State','Gauteng','Limpopo','Mpumalanga','North West','Northern Cape','Western Cape'] as $province)
                <option @if(old('province') == $province) selected @endif value="{{$province}}">{{$province}}</option>
              @endforeach
            </select>
            @error('province')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{--
            <label for="address_code">Address Code</label>
            <input name="address_code" type="text" class="form-control" value="{{ old('address_code', $client->address_code) }}">
            @error('address_code')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            --}}
        </div>

        {{-- <div class="form-group col-md-4">
            <label for="postal_line_1">Postal address line 1</label>
            <input name="postal_line_1" type="text" class="form-control" value="{{ old('postal_line_1', $client->postal_line_1) }}">
              @error('postal_line_1')
                  <span class="invalid-feedback" style="display:unset;" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            <label for="postal_line_2">Postal address line 2</label>
            <input name="postal_line_2" type="text" class="form-control" value="{{ old('postal_line_2', $client->address_line_2) }}">
              @error('address_line_2')
                  <span class="invalid-feedback" style="display:unset;" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            <label for="inputPassword4">Postal city</label>
            <input name="postal_city" type="text" class="form-control" value="{{ old('postal_city', $client->postal_city) }}">
            @error('postal_city')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="inputPassword4">Postal province</label>
            <select name="postal_province" id="" class="form-control">
              @foreach(['KwaZulu-Natal','Eastern Cape','Free State','Gauteng','Limpopo','Mpumalanga','North West','Northern Cape','Western Cape'] as $province)
                <option @if(old('postal_province') == $province) selected @endif value="{{$province}}">{{$province}}</option>
              @endforeach
            </select>
            @error('postal_province')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label for="inputPassword4">Postal code</label>
            <input name="postal_code" type="text" class="form-control" value="{{ old('postal_code', $client->postal_code) }}">
            @error('postal_code')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div> --}}
    </div>

    <input type="hidden" name="country_id" value="1">

    <h6 class="mt-2">Business information</h6>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Years in business</label>
            <input name="years_in_business" type="number" class="form-control" value="{{ old('years_in_business', $client->years_in_business) }}">

            @error('years_in_business')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Business type</label>
             <select name="business_type" id="" class="form-control">
                @foreach(['OT','Type 2'] as $business_type)
                  <option @if(old('business_type', $client->business_type)) selected @endif value="{{$business_type}}">{{$business_type}}</option>
                @endforeach
            </select>

            @error('business_type')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>Employment type</label>
            <select name="employment_type" id="" class="form-control">
                @foreach(['full time','part time','OT'] as $employment_type)
                  <option @if(old('employment_type', $client->employment_type)) selected @endif value="{{$employment_type}}">{{$employment_type}}</option>
                @endforeach
            </select>
            @error('employment_type')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <h6 class="mt-2">Other information</h6>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Agreed to privacy policy</label>

            <select name="agreed_to_privacy_policy"  class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            @error('agreed_to_privacy_policy')
                <span class="invalid-feedback" style="display:unset;" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>