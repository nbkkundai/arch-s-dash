  <div class="row mt-4">
    <div class="col-md-6">
      
        <label class="form-label">Name</label>
        <input name="name" type="text" class="form-control" value="{{ old('name', $centre->name) }}">
        @error('name')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>
    <div class="col-md-6">
      
        <label class="form-label">Centre code</label>
        <input name="code" type="text" class="form-control" value="{{ old('code', $centre->code) }}">
        @error('code')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6">
      
        <label class="form-label">Address line 1</label>
        <input name="address_line_1" type="text" class="form-control" value="{{ old('address_line_1', $centre->address_line_1) }}">
        @error('address_line_1')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>

    <div class="col-md-6">
      
        <label class="form-label">Address line 2</label>
        <input name="address_line_2" type="text" class="form-control" value="{{ old('address_line_2', $centre->address_line_2) }}">
        @error('address_line_2')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6">
      
        <label class="form-label">City</label>
        <input name="city" type="text" class="form-control" value="{{ old('city', $centre->city) }}">
        @error('city')
            <span class="invalid-feedback" style="display:unset;" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      
    </div>

    <div class="col-md-6">
      
        <label class="form-label">Province</label>
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
      
    </div>
  </div>