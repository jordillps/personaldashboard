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
            <div id="response"></div>
            <div id='calendar'>
                <!-- The Modal -->
                {{-- <div id="showevent" class="modal"> --}}

                    <!-- Modal content -->
                    {{-- <div id="modalcontent" class="modal-content" > --}}
                        {{-- <p>Some text in the Modal..</p> --}}
                    {{-- </div> --}}

                {{-- </div> --}}
            </div>
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
    <script src="{{ asset('fullcalendar/moment/moment.min.js') }}"></script>
          <script>
                document.addEventListener('DOMContentLoaded', function() {

                    var calendarEl = document.getElementById('calendar');
                    var response = document.getElementById('response');
                    var modal = document.getElementById("showevent");
                    var modalcontent = document.getElementById("modalcontent");
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
                        timeZone: 'Europe/Madrid',
                        themeSystem: 'bootstrap',
                        height: 'auto',
                        eventColor: '#378006',
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
                                calendar.addEvent({
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
                        eventMouseEnter: function(info){
                           //modal.style.display = "block";
                           //modalcontent.innerHTML=
                           //"<p>"+info.event.title+"</p>";
                        },
                        eventMouseLeave: function(info){
                            //modal.style.display = "none";
                        },

                        //Update an event
                        eventDrop: function (info) {
                            var start = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
                            var end = moment(info.event.end).format('YYYY-MM-DD HH:mm:ss');
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




