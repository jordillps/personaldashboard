
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

