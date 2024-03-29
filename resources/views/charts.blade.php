@extends('layouts.app')

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
                    <a href="#">@lang('global.charts')</a>
                </li>
            </ol>

        <!-- Area Chart Example-->
            <div class="row mx-auto">
                <div class="col-12 col-xl-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                             @lang('global.chart')
                        </div>
                        <div class="card-body">
                                {!! $userschartbar->container() !!}
                        </div>
                         <div class="card-footer small text-muted"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            @lang('global.chart')
                        </div>
                        <div class="card-body">
                                {!! $userschartdoughnut->container() !!}
                        </div>
                        <div class="card-footer small text-muted"></div>
                    </div>
                </div>
            </div>
        </div>

      <!-- /.container-fluid -->

      @include('partials.footer')

    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $userschartbar->script() !!}
    {!! $userschartdoughnut->script() !!}
@endpush



