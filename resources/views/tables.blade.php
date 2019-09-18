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
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            @lang('global.users')</div>
          <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.role')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.created')</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>@lang('global.id')</th>
                        <th>@lang('global.role')</th>
                        <th>@lang('global.name')</th>
                        <th>@lang('global.email')</th>
                        <th>@lang('global.created')</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
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
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->
@endsection



