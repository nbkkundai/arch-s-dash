@extends('layouts.admin.layout')

@section('content')
<div>
    <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-icon card-header-rose">
              <div class="card-icon">
                <i class="material-icons">perm_identity</i>
              </div>
              <h4 class="card-title">Updated password
              </h4>
            </div>
            <div class="card-body">
              
                <form action="/users/{{$user->slug}}/change-password" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group">
                          <label class="form-label">Current password</label>
                          
                          <input name="old_password" type="password" class="form-control" value="{{old('old_password')}}">
                          @error('old_password')
                              <span class="invalid-feedback" style="display:unset;" role="alert">
                                  <strong> hin {{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group">
                          <label class="form-label">New password</label>
                          
                          <input name="password" type="password" class="form-control">
                          @error('password')
                              <span class="invalid-feedback" style="display:unset;" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group">
                          <label class="form-label">Confirm new password</label>
                          
                          <input name="password_confirmation" type="password" class="form-control">
                          @error('password_confirmation')
                              <span class="invalid-feedback" style="display:unset;" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Update Password</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection

