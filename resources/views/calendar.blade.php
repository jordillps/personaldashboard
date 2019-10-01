@extends('layouts.app')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@push('styles')
    <link href="{{asset('fullcalendar/css/core/main.css')}}" rel='stylesheet' />
    <link href="{{asset('fullcalendar/css/daygrid/main.css')}}" rel='stylesheet' />
    <link href="{{asset('fullcalendar/bootstrap/main.css')}}" rel='stylesheet' />
    <link href="{{asset('fullcalendar/css/timegrid/main.css')}}" rel='stylesheet' />
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
    <script src="{{ asset('fullcalendar/js/core/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/js/daygrid/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/locales/es.js') }}"></script>
    <script src="{{ asset('fullcalendar/bootstrap/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/js/interaction/main.js') }}"></script>
    <script src="{{ asset('fullcalendar/js/timegrid/main.js') }}"></script>
          <script>
                document.addEventListener('DOMContentLoaded', function() {

                    var calendarEl = document.getElementById('calendar');
                    var locale_lang = "{{app()->getLocale()}}";
                    var SITEURL = "{{url('/home/calendar')}}";
                    var ID = "{{Auth::id()}}";

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [ 'interaction', 'dayGrid', 'timeGrid','bootstrap' ],
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        locale: locale_lang,
                        themeSystem: 'bootstrap',
                        height: 'auto',
                        events: [

                                @foreach($events as $event)
                                {
                                    title : '{{ $event->title }}',
                                    start : '{{ $event->start }}',
                                    end: '{{ $event->end }}',
                                },
                                @endforeach

                        ],
                        defaultDate: '2019-10-01',
                        navLinks: true, // can click day/week names to navigate views
                        selectable: true,
                        selectMirror: true,
                        select: function(arg) {
                            var title = prompt('Event Title:');
                            var location =prompt('Event Location:');

                            if (title) {
                                var created_at = new Date();
                                calendar.addEvent({
                                    title: title,
                                    location:location,
                                    start: arg.start,
                                    end: arg.end,
                                    allDay: arg.allDay
                                })

                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: SITEURL + "/create",
                                    data:{user_id:ID, title:title, location:location,start:arg.startStr,end:arg.endStr, created_at:created_at},
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("@lang('global.eventadded')");
                                    }
                                });
                            }
                            calendar.unselect()
                        },
                        editable: true,
                        eventLimit: true,

                    });
                    calendar.render();
                    function displayMessage(message) {
                        $(".response").html("<div class='alert alert-success' role='alert'>"+message+"</div>");
                        setInterval(function() { $(".success").fadeOut(); }, 1000);
                      }

                });



          </script>

@endpush




