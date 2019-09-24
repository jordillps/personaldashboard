@extends('layouts.app')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

        <script>
            $(document).ready(function () {

                  var SITEURL = "{{url('/home/calendar')}}";
                  var ID = "{{Auth::id()}}";
                  console.log(ID);
                  $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });

                  var calendar = $('#calendar').fullCalendar({
                      header: {
                        left: 'prev,next today',
                        center: 'title',
                      },
                      editable: true,
                      events: SITEURL, //+ "fullcalendar",
                      displayEventTime: true,
                      editable: true,
                      eventRender: function (event, element, view) {
                          if (event.allDay === 'true') {
                              event.allDay = true;
                          } else {
                              event.allDay = false;
                          }
                      },
                      selectable: true,
                      selectHelper: true,
                      select: function (start, end, allDay) {
                          var title = prompt('Event Title:');
                          var location =prompt('Event Location');

                          if (title) {
                              var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                              var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                              var created_at = new Date();
                              $.ajax({
                                  url: SITEURL + "/create",
                                  data:{user_id:ID, title:title, location:location,start:start,end:end, created_at:created_at},
                                  type: "POST",
                                  success: function (data) {
                                      displayMessage("Added Successfully");
                                  }
                              });
                              calendar.fullCalendar('renderEvent',
                                      {
                                          title: title,
                                          location: location,
                                          start: start,
                                          end: end,
                                          allDay: allDay
                                      },
                              true
                                      );
                          }
                          calendar.fullCalendar('unselect');
                      },

                      eventDrop: function (event, delta) {
                                  var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                                  var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                                  $.ajax({
                                      url: SITEURL + '/update',
                                      data:{id:event.id,user_id:event.user_id, title:event.title, location:event.location,start:start,end:end},
                                      type: "POST",
                                      success: function (response) {
                                          displayMessage("Updated Successfully");
                                      }
                                  });
                              },
                      eventClick: function (event) {
                          var deleteMsg = confirm("Do you really want to delete?");
                          if (deleteMsg) {
                              $.ajax({
                                  type: "POST",
                                  url: SITEURL + '/delete',
                                  data: {id:event.id},
                                  success: function (response) {
                                      if(parseInt(response) > 0) {
                                          $('#calendar').fullCalendar('removeEvents', event.id);
                                          displayMessage("Deleted Successfully");
                                      }
                                  }
                              });
                          }
                      }

                  });
            });

            function displayMessage(message) {
              $(".response").html("<div class='alert alert-success' role='alert'>"+message+"</div>");
              setInterval(function() { $(".success").fadeOut(); }, 3000);
            }
          </script>
@endpush




