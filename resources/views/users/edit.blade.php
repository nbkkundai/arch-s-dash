@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/assets/vendor/select2/select2.min.css" />
@endsection

@section('content')
<div class="card">
  <div class="m-3 row">
      <div class="col-6">
          <h5 class="mt-3"><b>Edit Profile</b></h5>
      </div>
      <div class="col-md-6">                  
        @if(Auth::user()->hasAnyRole(['Super Admin']))
          <form action="/users/{{$user->slug}}/resert-password" method="POST" enctype="multipart/form-data"> 
            @csrf
            @method('PUT')           
            <button data-toggle="modal" data-target="#deactivateModal{{$user->id}}" type="button" class="btn pull-right">Reset Password</button>

            <div class="modal fade" id="deactivateModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title text-left" id="exampleModalLongTitle">Reset {{$user->first_name}} {{$user->last_name}} password</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to reset this user ({{$user->first_name}} {{$user->last_name}})'s password?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Reset</button>
                  </div>
                  </div>
              </div>
          </div>
          </form>
        @endif
      </div>
  </div>
</div>

<div>
    <div class="row">
        <div class="col-md-12">
          <div class="card" style="border-radius: 0">
              <div class="card-header card-header-icon card-header-rose">
                <div class="row">
        
                </div>
              </div>
              <div class="card-body">
                <form action="/users/{{$user->slug}}/update" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  @include('partials.user-form')
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <a class="btn btn-secondary text-white" onclick="history.back()">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Update Profile</button>
                    </div>
                  </div>
                </form>

              </div>
            
          </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript" src="/assets/vendor/select2/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({});
    });
</script>

@endsection
