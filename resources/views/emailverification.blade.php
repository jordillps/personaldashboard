@extends('layouts.app')

@section('welcome')
    <!-- Full Page Image Header with Vertically Centered Content -->
    <div class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <div class="jumbotron mx-auto">
                        <div class="container">
                            <h2>@lang('global.emailverification')</h2>
                            <h5>@lang('global.checkyouremailbox')</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
