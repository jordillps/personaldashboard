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

            <div class="container">
                    <div class="card card-register mx-auto mt-5">
                      <div class="card-header">@lang('global.profile')</div>
                      <div class="card-body">
                        <form>
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-6">
                                <div class="form-label-group">
                                  <input type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                                  <label for="firstName">First name</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-label-group">
                                  <input type="text" id="lastName" class="form-control" placeholder="Last name" required="required">
                                  <label for="lastName">Last name</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-label-group">
                              <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                              <label for="inputEmail">Email address</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-6">
                                <div class="form-label-group">
                                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                                  <label for="inputPassword">Password</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-label-group">
                                  <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                                  <label for="confirmPassword">Confirm password</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <a class="btn btn-primary btn-block" href="login.html">Register</a>
                        </form>
                      </div>
                    </div>
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




