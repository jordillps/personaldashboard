@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">@lang('auth.login')</h5>
                <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                  <div class="form-label-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="email">@lang('auth.email')</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="form-label-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                        <label for="password">@lang('auth.password')</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>
                  <div class="form-label-group">
                    <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">@lang('auth.rememberme')</label>
                    </div>
                  </div>
                  <div class="form-label-group">
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">@lang('auth.login')</button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    @lang('auth.forgotyourpassword')
                                </a>
                            @endif
                  </div>
                </form>
                    <hr class="my-4">
                    <a class="btn btn-outline-primary btn-block" href="{{ route('register') }}">@lang('auth.register')</a>
                    <a class="btn btn-outline-primary btn-block" href="{{ route('welcome') }}">@lang('global.home')</a>
                    <hr class="my-4">
                    {{-- <button class="btn btn-lg btn-google btn-block" type="submit"><i class="fab fa-google mr-2"></i>@lang('global.Sign in with Google')</button> --}}
                    {{-- <button class="btn btn-lg btn-facebook btn-block" type="submit"><i class="fab fa-facebook-f mr-2"></i>@lang('global.Sign in with Facebook')</button> --}}
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
