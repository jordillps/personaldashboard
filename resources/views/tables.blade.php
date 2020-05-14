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
            <a href="#">@lang('global.tables')</a>
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
            @lang('global.users')</div>
          <div class="card-body">
              <div class="mb-3 text-right">
                    <a href="{{ route('home.tables.export') }}" class="btn btn-primary btn-sm">@lang('global.exportToExcel')</a>
              </div>
                <div class="table-responsive">
                <table class="table table-bordered table-hover" id="user_datatable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.role')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.birthdate')</th>
                        <th>@lang('global.image')</th>
                        @if(auth()->user()->isAdmin())
                        {{-- @if(auth()->user()->role->name == 'admin') --}}
                            <th>@lang('global.action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.role')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.birthdate')</th>
                        <th>@lang('global.image')</th>
                        @if(auth()->user()->isAdmin())
                        {{-- @if(auth()->user()->role->name == 'admin') --}}
                            <th>@lang('global.action')</th>
                        @endif
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ Carbon\Carbon::parse($user->birthdate)->format('d-m-Y') }}</td>
                        @if($user->avatar == 0)
                            <td><img class="img-thumbnail" height="45" width="45" src="/images/avatar-icon.png" /></td>
                        @else
                            <td><img class="img-thumbnail" height="45" width="45" src="/storage/avatars/{{ $user->avatar }}" /></td>
                        @endif

                        @if(auth()->user()->isAdmin())
                        {{-- @if(auth()->user()->role->name == 'admin') --}}
                            <td>
                            @if(auth()->user()->id != $user->id)
                                <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteUserConfirmation" data-user-id="{{ $user->id }}"><i class="fa fa-trash"></i></a>
                            @endif
                            </td>
                        @endif
                    </tr>
                    @empty
                        <p>@lang('global.No users')</p>
                    @endforelse
                    </tbody>
                </table>
                </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Modal-->
        <form action="" id="deleteUserForm" method="POST">
            <div class="modal" id="deleteUserConfirmation" tabindex="-1" role="dialog">
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
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © FormalWeb 2020</span>
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
            $('#user_datatable').DataTable({
                    "language": {
                        "url": language_datatable
                    },
            });

            $('#deleteUserForm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                const id = 'id';
                var route = "{{ route('home.tables.destroy', ['id' => 'id' ]) }}";
                route = route.replace('id',button.data('user-id'));
                $('#deleteUserForm').attr('action', route);
            });

        });





    </script>
@endpush




