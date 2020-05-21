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
            <a href="#">@lang('global.reservations')</a>
          </li>
          {{-- <li class="breadcrumb-item active">@lang('global.tables')</li> --}}
        </ol>

        <!-- DataTables -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>@lang($message)</strong>
            </div>
        @endif
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            @lang('global.reservations')</div>
          <div class="card-body">
              <div class="mb-3 text-right">
                    <a href="{{ route('home.reservations.export') }}" class="btn btn-primary btn-sm">@lang('global.exportToExcel')</a>
              </div>
                <div class="table-responsive">
                <table class="table table-bordered table-hover" id="reservation_datatable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.phone')</th>
                        <th>@lang('global.reservation_date')</th>
                        <th>@lang('global.slot')</th>
                        @if(auth()->user()->isAdmin())
                            <th>@lang('global.action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.phone')</th>
                        <th>@lang('global.reservation_date')</th>
                        <th>@lang('global.slot')</th>
                        @if(auth()->user()->isAdmin())
                            <th>@lang('global.action')</th>
                        @endif
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse ($reservations as $reservation)
                    <tr>
                        <td>{{$reservation->id}}</td>
                        <td>{{$reservation->name}}</td>
                        <td>{{$reservation->email}}</td>
                        <td>{{$reservation->phone}}</td>
                        <td>{{ Carbon\Carbon::parse($reservation->reservation_date)->format('d-m-Y') }}</td>
                        <td>{{$reservation->slot}}</td>
                        @if(auth()->user()->isAdmin())
                            <td>
                                {{-- <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#deleteModal" data-reservation-id="{{ $reservation->id }}"><i class="fa fa-trash"></i></button> --}}
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" data-reservation-id="{{ $reservation->id }}"><i class="fa fa-trash"></i></a>
                            </td>
                        @endif
                    </tr>
                    @empty
                        <p>@lang('global.No reservations')</p>
                    @endforelse
                    </tbody>
                </table>
                </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

        @if ($reservations->count() > 0)
            <form action="" id="deleteReservationForm" method="POST" >
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    {{ csrf_field() }}
                    {{ method_field('DELETE')}}
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header alert-warning">
                                <h5 class="modal-title text-uppercase" id="exampleModalLabel">@lang('global.confirmdelete')</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>@lang('global.sure')</p>
                            </div>
                            <div class="modal-footer alert-warning">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.cancel')</button>
                            <button class="btn btn-primary">@lang('global.delete')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        <!-- Modal -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © FormalWeb 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script>

        $(document).ready( function () {
            var locale_lang = "{{app()->getLocale()}}";
            switch(locale_lang) {
                case 'en':
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
                    break;
                case 'es':
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json";
                    break;
                case 'ca':
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Catalan.json";
                    break;
                default:
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
            }
            $('#reservation_datatable').DataTable({
                    "language": {
                        "url": language_datatable
                    },
            });

            $('#deleteReservationForm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                const id = 'id';
                var route = "{{ route('home.reservations.destroy', ['id' => 'id' ]) }}";
                route = route.replace('id',button.data('reservation-id'));
                $('#deleteReservationForm').attr('action', route);
            });

        });





    </script>
@endpush




