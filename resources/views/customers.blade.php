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
            <a href="#">@lang('global.customers')</a>
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
            @lang('global.customers')</div>
          <div class="card-body">
              <div class="mb-3 text-right">
                    <a href="{{ route('home.customers.export') }}" class="btn btn-primary btn-sm">@lang('global.exportToExcel')</a>
              </div>
                <div class="table-responsive">
                @if(count($customers) > 0)
                    <table class="table table-bordered table-hover" id="user_datatable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>@lang('global.id')</th>
                            <th>@lang('global.name')</th>
                            <th>@lang('global.email')</th>
                            <th>@lang('global.phone')</th>
                            @if(auth()->user()->isAdmin())
                            {{-- @if(auth()->user()->role->name == 'admin') --}}
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
                            @if(auth()->user()->isAdmin())
                            {{-- @if(auth()->user()->role->name == 'admin') --}}
                                <th>@lang('global.action')</th>
                            @endif
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse ($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$customer->phone}}</td>

                            @if(auth()->user()->isAdmin())
                            {{-- @if(auth()->user()->role->name == 'admin') --}}
                                <td>
                                    <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteCustomerConfirmation" data-customer-id="{{ $customer->id }}"><i class="fa fa-trash"></i></a>
                                </td>
                            @endif
                        </tr>
                        @empty
                            <p>@lang('global.No customers')</p>
                        @endforelse
                        </tbody>
                    </table>
                @else
                <h3>@lang('global.No customers')</h3>
                @endif
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Modal-->
        <form action="" id="deleteCustomerForm" method="POST">
            <div class="modal" id="deleteCustomerConfirmation" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                        @method('DELETE')
                        @csrf
                    <div class="modal-content">
                    <div class="modal-header alert-warning">
                        <h5 class="modal-title text-uppercase">@lang('global.deleteconfirmationtitle')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('global.deleteconfirmationmessage')</p>
                    </div>
                    <div class="modal-footer alert-warning">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.deleteconfirmationcancel')</button>
                        <button type="submit" class="btn btn-primary">@lang('global.deleteconfirmationdelete')</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- End Modal-->

      <!-- Sticky Footer -->
      @include('partials.footer')

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
            $('#user_datatable').DataTable({
                    "language": {
                        "url": language_datatable
                    },
            });

            $('#deleteCustomerForm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                const id = 'id';
                var route = "{{ route('home.customers.destroy', ['id' => 'id' ]) }}";
                route = route.replace('id',button.data('customer-id'));
                $('#deleteCustomerForm').attr('action', route);
            });

        });





    </script>
@endpush




