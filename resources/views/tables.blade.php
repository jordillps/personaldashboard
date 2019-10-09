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
                <strong>{{ $message }}</strong>
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
                <table class="table table-bordered" id="user_datatable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.role')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.birthdate')</th>
                        <th>@lang('global.action')</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.role')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.birthdate')</th>
                        <th>@lang('global.action')</th>
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
                        <td>
                            <form action="{{ route('home.tables.destroy', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <p>@lang('global.No users')</p>
                    @endforelse
                    </tbody>
                </table>
                </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
        $('#user_datatable').DataTable({
            "language": {
                "lengthMenu": "Muestra _MENU_ registros por página",
                "zeroRecords": "No se han encontrado registros",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No se han encontrado registros",
                "infoFiltered": "(filtrado de _MAX_ registros totales)"
            }
            });
        });
    </script>
@endpush




