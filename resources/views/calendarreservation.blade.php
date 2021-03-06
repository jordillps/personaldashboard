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
    <style>
        .tooltip-inner {
            white-space:pre-wrap;
        }
    </style>
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
            <div class="row d-flex justify-content-between">
                <div class="alert alert-info"><i class="fas fa-fw fa-info-circle"></i><strong>@lang('global.createreservationsinfo')</strong></div>
                <div class="alert alert-info"><i class="fas fa-fw fa-info-circle"></i><strong>@lang('global.updatereservationsinfo')</strong></div>
                <div class="alert alert-info"><i class="fas fa-fw fa-info-circle"></i><strong>@lang('global.deletereservationsinfo')</strong></div>
            </div>

            <div id="response"></div>
            <div id='calendar'>
            </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Delete Modal-->
        <div class="modal" id="ReservationConfirmationDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header alert-warning">
                        <h5 class="modal-title text-uppercase">@lang('global.confirmdelete')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('global.sure')</p>
                    </div>
                    <div class="modal-footer alert-warning">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.cancel')</button>
                        <button type="submit" id="deleteReservationfromModal" class="btn btn-primary">@lang('global.delete')</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Modal-->
    <!-- Update Modal-->
    <div class="modal" id="ReservationConfirmationUpdate" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header alert-warning">
                    <h5 class="modal-title text-uppercase">@lang('global.confirmupdate')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>@lang('global.sure')</p>
                </div>
                <div class="modal-footer alert-warning">
                    <button type="button" id="CancelReservationfromModal" class="btn btn-secondary" data-dismiss="modal">@lang('global.cancel')</button>
                    <button type="submit" id="UpdateReservationfromModal" class="btn btn-primary">@lang('global.update')</button>
                </div>
            </div>
        </div>
    </div>
<!-- End Modal-->

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
                    var SITEURL = "{{url('/home/reservations/calendar')}}";


                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [ 'interaction', 'dayGrid', 'timeGrid','bootstrap','googleCalendar' ],
                        header: {
                            left: 'prev,next',
                            center: 'title',
                            right: 'timeGridWeek,timeGridDay,dayGridMonth'
                        },
                        titleFormat:{
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        },
                        locale: locale_lang,
                        timeZone: 'Europe/Madrid',
                        themeSystem: 'bootstrap',
                        height: 'auto',
                        eventColor: '#378006',
                        eventBorderColor: '#000',
                        firstDay: 1,
                        events: [

                                @foreach($reservations as $reservation)
                                {
                                    id: '{{ $reservation->id }}',
                                    title:'{{ $reservation->name }}',
                                    extendedProps: {
                                        email : '{{ $reservation->email }}',
                                        phone : '{{ $reservation->phone }}',
                                      },
                                    start : '{{ $reservation->start }}',
                                    end: '{{ $reservation->end }}',
                                },
                                @endforeach

                        ],
                        eventTimeFormat: { // like '14:30:00'
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false,
                        },
                        minTime:'10:00',
                        maxTime:'20:00',
                        businessHours: [ // specify an array instead
                            {
                                daysOfWeek: [ 1, 2, 3, 4, 5, 6 ], // Monday, Tuesday, Wednesday
                                startTime: '10:00', // 10am
                                endTime: '14:00' // 2pm]
                            },
                            {
                                daysOfWeek: [ 1, 2, 3, 4, 5, 6], // Monday, Tuesday, Wednesday
                                startTime: '17:00', // 5am
                                endTime: '20:00' // 8pm
                            },
                        ],
                        eventConstraint:"businessHours",
                        allDaySlot: false,
                        showNonCurrentDates: false,
                        nowIndicator: true,
                        displayEventEnd: true,
                        eventRender: function (info) {
                            if(info.view.type == 'timeGridDay'){
                                displayEventTime : true;
                            }else{
                                $(info.el).tooltip({
                                    title: function(){
                                        return  info.event.title+'   Tel:'+info.event.extendedProps.phone;
                                    },
                                    placement: 'top',
                                    trigger: 'hover',
                                    container: 'body',
                                    delay: { "show": 500, "hide": 100 }
                                });
                            }

                        },
                        defaultDate: new Date(),
                        navLinks: true, // can click day/week names to navigate views
                        selectable: true,
                        selectMirror: true,
                        selectHelper: true,
                        //Add an event
                        select: function(arg) {
                            var name = prompt("@lang('global.namereservation')");
                            var email =prompt("@lang('global.emailreservation')");
                            var phone =prompt("@lang('global.phonereservation')");

                            if (name && email && phone && ValidateEmail(email) && ValidatePhone(phone)) {
                                calendar.addEvent({
                                    name: name,
                                    email:email,
                                    phone:phone,
                                    reservation_date:arg.startStr,
                                    start: arg.start,
                                    end: arg.end,
                                });

                                var request = $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: SITEURL + "/create",
                                    data:{name:name, email:email,phone:phone,reservation_date:arg.startStr,start:arg.startStr,end:arg.endStr},
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage("@lang('global.reservationaddedsuccessfully')");
                                    }
                                });

                            }
                            calendar.unselect()
                        },
                        editable: true,
                        eventLimit: true,
                        //Delete event
                        eventClick: function(info) {
                            $('#ReservationConfirmationDelete').modal('show');

                            $("#deleteReservationfromModal").click(function () {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        type: "POST",
                                        url: SITEURL + '/delete',
                                        data: {id:info.event.id},
                                        success: function (response) {
                                                displayMessage("@lang('global.reservationdeletedsuccessfully')");
                                        }
                                    });
                                info.event.remove();
                                $('#ReservationConfirmationDelete').modal('hide');
                            });

                        },

                        //Update an event
                        eventDrop: function (info) {
                            //Restar una hora per la UTC local
                            var start = moment(info.event.start).subtract(2, "hours").format('YYYY-MM-DD HH:mm:ss');
                            var end = moment(info.event.end).subtract(2, "hours").format('YYYY-MM-DD HH:mm:ss');
                            var start_duration = moment(info.event.start).subtract(2, "hours");
                            var end_duration = moment(info.event.end).subtract(2, "hours");
                            var duration = moment.duration(end_duration.diff(start_duration));
                            var hours = duration.asHours();

                            if (hours == 0.5){
                                $('#ReservationConfirmationUpdate').modal('show');

                                $("#UpdateReservationfromModal").click(function () {
                                    $.ajax({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url: SITEURL + '/update',
                                        data:{id:info.event.id,title:info.event.title, email:info.event.extendedProps.email,
                                            phone:info.event.extendedProps.phone,start:start,end:end},
                                        type: "POST",
                                        success: function (response) {
                                            displayMessage("@lang('global.reservationupdatedsuccessfully')");
                                        }

                                    });
                                    $('#ReservationConfirmationUpdate').modal('hide');
                                });

                                $("#CancelReservationfromModal").click(function () {
                                    info.revert();
                                });

                            }else{
                                var ErrorDroppingMsg = alert("@lang('global.eventdroppednoslot')");
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

                    function ValidateEmail(email){
                        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        if(email.match(mailformat)){
                            return true;
                        }else{
                             alert("@lang('validation.email')");
                            return false;
                        }
                    }

                    function ValidatePhone(phone){
                        var phoneformat = /^\d{9}$/;
                        if(phone.match(phoneformat)){
                                return true;
                        }else{
                            alert("@lang('validation.phone')");
                            return false;
                        }
                    }



                });

          </script>

@endpush




