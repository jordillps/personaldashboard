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
            <a href="#">@lang('global.dashboard')</a>
          </li>
          {{-- <li class="breadcrumb-item active">Overview</li> --}}
        </ol>

        @include('partials.footer')

    </div>
    <!-- /.content-wrapper -->
@endsection



