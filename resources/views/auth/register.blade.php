
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">@lang('auth.register')</h5>
            <form method="POST" action="{{ route('register') }}"novalidate>
                    @csrf
              <div class="form-label-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <label for="name">@lang('auth.name')</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="form-label-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="email">@lang('auth.email')</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

              <hr>

              <div class="form-label-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">
                    <label for="password">@lang('auth.password')</label>
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>

              <div class="form-label-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    required autocomplete="new-password">
                <label for="password-confirm">@lang('auth.confirmpassword')</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">@lang('auth.register')</button>
            </form>
              <hr class="my-4">
              <a class="btn btn-outline-primary btn-block" href="{{ route('login') }}">@lang('auth.login')</a>
              <a class="btn btn-outline-primary btn-block" href="{{ route('welcome') }}">@lang('global.home')</a>
              <hr class="my-4">
              {{-- <button class="btn btn-lg btn-google btn-block" type="submit"><i class="fab fa-google mr-2"></i>@lang('global.Sign up with Google')</button> --}}
              {{-- <button class="btn btn-lg btn-facebook btn-block" type="submit"><i class="fab fa-facebook-f mr-2"></i>@lang('global.Sign up with Facebook')</button> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  @section('content')
