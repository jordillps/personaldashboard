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
            <a href="#">@lang('global.import')</a>
          </li>
          {{-- <li class="breadcrumb-item active">@lang('global.tables')</li> --}}
        </ol>

        <!-- DataTables -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            @lang('global.dataimport')</div>
          <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>@lang($message)</strong>
                    </div>
                @endif
                <div class="mb-3">
                    <form action="{{ route('home.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control mb-3 {{ $errors->has('file') ? ' is-invalid' : '' }}">
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-primary btn-sm">@lang('global.importFromExcel')</button>
                    </form>
                </div>
                <hr>
                <div class="table-responsive">
                    <h3 class="mb-2">@lang('global.partners')</h3> 
                        <table class="table table-bordered table-hover" id="user_datatable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>@lang('global.id')</th>
                                <th>@lang('global.name')</th>
                                <th>@lang('global.email')</th>
                                <th>@lang('global.birthdate')</th>
                                <th>@lang('global.printpdf')</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>@lang('global.id')</th>
                                <th>@lang('global.name')</th>
                                <th>@lang('global.email')</th>
                                <th>@lang('global.birthdate')</th>
                                <th>@lang('global.printpdf')</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @forelse ($partners as $partner)   
                                    <tr>
                                        <td>{{$partner->id}}</td>
                                        <td>{{$partner->name}}</td>
                                        <td>{{$partner->email}}</td>
                                        <td>{{ Carbon\Carbon::parse($partner->birthdate)->format('d-m-Y') }}</td>
                                        <td align="center"><a href="{{route('home.import.printpdf', $partner)}}"><i class="fas fa-file-pdf"></i></a></td>
                                    </tr>
                                @empty
                                        <h3>@lang('global.nopartners')</h3>
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




