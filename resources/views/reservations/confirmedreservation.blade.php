@extends('layouts.layout')

@push('styles')
    <link rel="stylesheet" href="/css/styles.css">
@endpush


@section('content')

    <div class="card card-elegant">
        <img class="card-img-top" src="/images/card.jpg" width="100%" alt="Card image cap">
        <div class="card-block">
            <h6 class="card-title"><small>@lang('global.confirmedreservation')</small></h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.name'): </strong> {{$reservation->name}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.email'): </strong> {{$reservation->email}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.phone'): </strong> {{$reservation->phone}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.date'): </strong> {{$reservation->reservation_date->format('d-m-Y')}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-success text-center" role="alert">
                        <strong>@lang('global.hour'): </strong> {{$reservation->slot}}
                    </div>
                </div>
            </div>
            <div class="row">
                @if(session()->has('flash'))
                    <div class="alert alert-success">{{session('flash')}}</div>
                @endif
            </div>
            <a href="{{url('/')}}" class="btn btn-primary">@lang('global.home')</a>
        </div>
    </div>

@endsection


