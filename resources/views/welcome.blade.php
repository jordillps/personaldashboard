@extends('layouts.app')

@section('welcome')
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">@lang('global.agenda')</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                        @if (Route::has('login'))
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/home') }}">@lang('global.agenda')</a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">@lang('global.login')</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">@lang('global.register')</a>
                                    </li>
                                @endauth
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservationform') }}">@lang('global.reserve')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">@lang('global.contact')</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdownMenuLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >@lang('global.select language')</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('setLocale', ['es']) }}">@lang('global.spanish')</a>
                                <a class="dropdown-item" href="{{ route('setLocale', ['en']) }}">@lang('global.english')</a>
                            </div>
                        </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Full Page Image Header with Vertically Centered Content -->
    <div class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 class="font-weight-light">@lang('global.agenda')</h1>
                    <p class="lead">@lang('global.organize')</p>
                </div>
            </div>
        </div>
    </div>
@endsection
