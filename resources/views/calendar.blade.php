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
            <div class="alert alert-info">@lang('global.createdeleteeventsinfo')</div>
            <div id="response"></div>
            <div id='calendar'>
            </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      @include('partials.footer')

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
    <script src="{{ asset('fullcalendar/moment/moment.min.js') }}"></script>
    <script src="{{ asset('fullcalendar/googlecalendar/main.js') }}"></script>
          <script>
                document.addEventListener('DOMContentLoaded', function() {

                    var calendarEl = document.getElementById('calendar');
                    var response = document.getElementById('response');
                    var locale_lang = "{{app()->getLocale()}}";
                    var SITEURL = "{{url('/home/calendar')}}";
                    var ID = "{{Auth::id()}}";

                    //Google Calendar Parameters
                    var GOOGLECALENDARID = "{{auth()->user()->googlecalendarid}}";
                    var GOOGLECALENDARAPIKEY = "{{auth()->user()->googlecalendarapikey}}";


                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [ 'interaction', 'dayGrid', 'timeGrid','bootstrap','googleCalendar' ],
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        locale: locale_lang,
                        timeZone: 'Europe/Madrid',
                        themeSystem: 'bootstrap',
                        height: 'auto',
                        eventColor: '#378006',
                        eventBorderColor: '#000',
                        events: [

                                @foreach($events as $event)
                                {
                                    id: '{{ $event->id }}',
                                    user_id:'{{ $event->user_id }}',
                                    title : '{{ $event->title }}',
                                    location : '{{ $event->location }}',
                                    start : '{{ $event->start }}',
                                    end: '{{ $event->end }}',
                                },
                                @endforeach

                        ],
                        //EVENTS GOOGLE CALENDAR
                        googleCalendarApiKey: GOOGLECALENDARAPIKEY,
                        eventSources: [
                                {
                                googleCalendarId: GOOGLECALENDARID
                                }

                        ],
                        eventTimeFormat: { // like '14:30:00'
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false,
                        },
                        //eventRender: function(info) {
                            //var tooltip = new Tooltip(info.el, {
                              //title: info.event.extendedProps.description,
                              //placement: 'top',
                              //trigger: 'hover',
                              //container: 'body'
                            //});
                          //},
                        defaultDate: new Date(),
                        navLinks: true, // can click day/week names to navigate views
                        selectable: true,
                        selectMirror: true,
                        selectHelper: true,
                        //Add an event
                        select: function(arg) {
                            var title = prompt("@lang('global.titleevent')");
                            var location =prompt("@lang('global.locationevent')");

                            if (title) {
                                var newevent = calendar.addEvent({
                                    user_id:ID,
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
                                    data:{user_id:ID, title:title, location:location,start:arg.startStr,end:arg.endStr},
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("@lang('global.eventadded')");
                                    }
                                });
                            }
                            console.log(newevent);
                            calendar.unselect()
                        },
                        editable: true,
                        eventLimit: true,
                        //Delete event
                        eventClick: function(info) {
                            var deleteMsg = confirm("@lang('global.eventdeleteconfirm')");
                            if (deleteMsg) {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    type: "POST",
                                    url: SITEURL + '/delete',
                                    data: {id:info.event.id},
                                    success: function (response) {
                                            displayMessage("@lang('global.eventdeletedsuccessfully')");
                                    }
                                });
                                info.event.remove();
                            }
                        },

                        //Update an event
                        eventDrop: function (info) {
                            //Restar una hora per la UTC local
                            var start = moment(info.event.start).subtract(1, "hours").format('YYYY-MM-DD HH:mm:ss');
                            var end = moment(info.event.end).subtract(1, "hours").format('YYYY-MM-DD HH:mm:ss');
                            //alert(info.event.title + "@lang('global.eventdropinfo')" + start);
                            var dropMsg = confirm("@lang('global.eventdroppedconfirm')");
                            if (dropMsg) {
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: SITEURL + '/update',
                                    data:{id:info.event.id,user_id:info.event.extendedProps.user_id, title:info.event.title, location:info.event.extendedProps.location,start:start,end:end},
                                    type: "POST",
                                    success: function (response) {
                                        displayMessage("@lang('global.eventupdated')");
                                    }
                                });
                            }else{
                                info.revert();
                            }

                        },

                    });
                    console.log(calendar.getEvents());
                    calendar.render();

                    function displayMessage(message) {
                        response.innerHTML = "<div class='alert alert-success' role='alert'>"+message+"</div>";
                        setTimeout(function(){
                            response.innerHTML = '';
                        }, 2000);

                    }

                });



          </script>

@endpush




