@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="/assets/vendor/select2/select2.min.css" />
@endsection

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10">
          <div class="card" style="border-radius: 0">
            <div class="card-header card-header-icon card-header-rose">
              <h4 class="card-title">Add user
              </h4>
            </div>
            <div class="card-body">
              
                <form action="/users" method="POST" enctype="multipart/form-data">
                @csrf
                @include('partials.user-form')

                <div class="row mt-4">
                    <div class="col-md-4">
                        <label class="form-label">Temporary Password</label>
                        <input type="hidden"  name="password" value="{{ $temp_password }}">
                        <input type="text" class="form-control" value="{{ $temp_password }}" disabled>
                        @error('password')
                            <span class="invalid-feedback" style="display:unset;" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <a href="/users" class="btn btn-secondary">Back</a>
                      <button type="submit" class="btn btn-success pull-right">Invite user via email</button>
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


@section('scripts')

<script type="text/javascript" src="/assets/vendor/select2/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({});
    });
</script>

@endsection

