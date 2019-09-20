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
            <a href="#">@lang('global.profile')</a>
          </li>
          {{-- <li class="breadcrumb-item active">@lang('global.tables')</li> --}}
        </ol>


      {{--  <!-- /.container-fluid -->  --}}
      </div>


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




