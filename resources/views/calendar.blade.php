@extends('layouts.app')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@push('styles')
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />  --}}
@endpush

@section('content')
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">@lang('global.calendar')</a>
          </li>
        </ol>

        <!-- Calendar -->
        <div class="container">
            <div class="response"></div>
            <div id='calendar'></div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
          <script>
                document.addEventListener('DOMContentLoaded', function() {

                    var calendarEl = document.getElementById('calendar');
                    var locale_lang = "{{app()->getLocale()}}";

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                      plugins: [ 'dayGrid','bootstrap' ],
                      locale: locale_lang,
                      themeSystem: 'bootstrap',
                    });

                    calendar.render();
                  });

          </script>

@endpush




