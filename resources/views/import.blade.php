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
                    <h3>@lang('global.dataimport')</h3>
                </div>
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
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="mb-2">@lang('global.partners')</h3>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                                @if(count($partners) > 0)
                                    <table class="table table-bordered table-hover" id="user_datatable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>@lang('global.id')</th>
                                            <th>@lang('global.name')</th>
                                            <th>@lang('global.email')</th>
                                            <th>@lang('global.birthdate')</th>
                                            <th>@lang('global.donation')</th>
                                            <th>@lang('global.printpdf')</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>@lang('global.id')</th>
                                            <th>@lang('global.name')</th>
                                            <th>@lang('global.email')</th>
                                            <th>@lang('global.birthdate')</th>
                                            <th>@lang('global.donation')</th>
                                            <th>@lang('global.printpdf')</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($partners as $partner)
                                                <tr>
                                                    <td>{{$partner->id}}</td>
                                                    <td>{{$partner->name}}</td>
                                                    <td>{{$partner->email}}</td>
                                                    <td>{{ Carbon\Carbon::parse($partner->birthdate)->format('d-m-Y') }}</td>
                                                    <td>{{$partner->donation}}</td>
                                                    <td align="center"><a href="{{route('home.import.printpdf', $partner)}}" data-toggle="tooltip" title="@lang('global.donationcertificate')"><i class="fas fa-file-pdf mr-2"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3>@lang('global.nopartners')</h3>
                                @endif
                        </div>
                </div>
            </div>

      </div>
      <!-- /.container-fluid -->

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
            $('#user_datatable').DataTable({
                    "language": {
                        "url": language_datatable
                    },
            });


        });





    </script>
@endpush




