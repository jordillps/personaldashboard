@extends('layouts.app')


@push('styles')
  <link rel="stylesheet" href="/css/menu/restaurant/styles.css" />
@endpush

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                <a href="#">@lang('global.restaurant-tables')</a>
                </li>
                {{-- <li class="breadcrumb-item active">@lang('global.tables')</li> --}}
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                  {{-- @lang('global.restaurant-tables') --}}
                  {{-- <h4><i class="fas fa-table"></i>{{ ucfirst(trans('menu')) }}</h4> --}}
                  <h4>{{$menu->description}}</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-1">
                        <div class="col-12 text-center">
                            <ul class="restaurant-tables">
                                @foreach ($tables as $table)
                                    @if(in_array($table->id, $unavailable_tables))
                                        <li>
                                            <div class="table-position">
                                                <a href="{{ route('home.restaurant.order.edit', $table)}}">
                                                    <img src="/images/table-restaurant.png" alt="table-restaurant" class="photo-table" />
                                                    <p>{{$table->id}}</p>
                                                </a>
                                            </div>
                                        </li>
                                    @else
                                        <li>
                                            <div class="table-position">
                                                    <img src="/images/table-restaurant.png" alt="table-restaurant" class="photo-table disabled" />
                                                    <p>{{$table->id}}</p>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Sticky Footer -->
      @include('partials.footer')

    </div>

@endsection
