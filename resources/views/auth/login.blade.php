@extends('layouts.blank')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <div class="card card-login" style="background:rgba(0, 0, 0, 0.526)">
                <div class="card-header" style="background:rgba(0,0,0,0.98)">
                    <img class="my-auto mb-5" src="/img/tino-full-logo.png" width="100" style="display: block; margin: auto">
                </div>

                <div class="card-body">
                    <h6 class="text-white">Login</h6>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group" style="background:#e9ecef">
                            <div class="input-group-prepend">
                              <span class="input-group-text mr-2">
                                <i class="nc-icon nc-single-02"></i>
                              </span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group" style="background:#e9ecef">
                            <div class="input-group-prepend">
                              <span class="input-group-text mr-2">
                                <i class="nc-icon nc-key-25"></i>
                              </span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <br />
                        <div class="form-group">
                        <div class="form-check">
                          <label class="form-check-label" for="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="form-check-sign"></span>
                            {{ __('Remember Me') }}
                          </label>
                        </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn  btn-block mb-3">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link btn-block" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                                <a class="btn btn-link btn-block" href="{{ route('register') }}">
                                    New to this platform? Sign-In.
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
