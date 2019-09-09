{{--  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    </head>
    <body>  --}}
@extends('layouts.app')

@section('content')
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">@lang('global.home')</a>
                    @else
                        <a href="{{ route('login') }}">@lang('global.login')</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">@lang('global.register')</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
@endsection
    {{--  </body>
</html>  --}}
