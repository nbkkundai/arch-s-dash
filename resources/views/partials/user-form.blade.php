
                <div class="row">
                  <div class="col-md-6">
                    
                      <label class="form-label">First name</label>
                      
                      <input name="first_name" type="text" class="form-control" value="{{ old('first_name', $user->first_name) }}">
                      @error('first_name')
                          <span class="invalid-feedback" style="display:unset;" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    
                  </div>
                  <div class="col-md-6">
                    
                      <label class="form-label">Last name</label>
                      <input name="last_name" type="text" class="form-control" value="{{ old('last_name', $user->last_name) }}">
                      @error('last_name')
                          <span class="invalid-feedback" style="display:unset;" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-md-6">
                    
                      <label class="form-label">Email address</label>
                      <input name="email" type="text" class="form-control" value="{{ old('email', $user->email) }}" @if($user->email) disabled @endif>
                      @error('email')
                          <span class="invalid-feedback" style="display:unset;" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    
                  </div>
                  <div class="col-md-6">
                    
                      <label class="form-label">Phone number</label>
                      <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}">
                      @error('phone')
                          <span class="invalid-feedback" style="display:unset;" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    
                  </div>
                </div>

                @if(Auth::user()->hasAnyRole(['Super Admin']))
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label class="form-label mb-0">Roles</label>
                        <select data-plugin="select2" name="roles[]" class="form-control js-example-basic-multiple" multiple="multiple">
                            @foreach($roles as $role)
                                <option @if($role->selected) selected @endif value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('roles')
                            <span class="invalid-feedback" style="display:unset;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endif