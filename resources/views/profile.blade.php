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
                    <div class="card-header">@lang('global.profile')</div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <form form method="POST" action="{{ route('home.profile.update') }}" novalidate enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                <div class="form-group">
                                        <div class="form-label-group">
                                                <input  id="inputName" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                name="name" value="{{ old('name') ?: $user->name }}" required autofocus/>
                                                @if($errors->has('name'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            <label for="inputName">@lang('global.firstname')</label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-label-group">
                                                    <input  id="inputEmail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    name="email" value="{{ old('email') ?: $user->email }}" required autofocus/>
                                                    @if($errors->has('email'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                <label for="inputEmail">@lang('global.emailaddress')</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-label-group">
                                                    <input  id="inputPhone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    name="phone" value="{{ old('phone') ?: $user->phone }}" autofocus/>
                                                    @if($errors->has('phone'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                <label for="inputPhone">@lang('global.telephone')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-label-group">
                                                        <input  id="inputPostalCode" type="text" class="form-control{{ $errors->has('postalcode') ? ' is-invalid' : '' }}"
                                                        name="postalcode" value="{{ old('postalcode') ?: $user->postalcode }}" autofocus/>
                                                        @if($errors->has('postalcode'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('postalcode') }}</strong>
                                                            </span>
                                                        @endif
                                                    <label for="inputPostalCode">@lang('global.postalcode')</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-label-group">
                                                        <input  id="inputCity" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                                        name="city" value="{{ old('city') ?: $user->city }}" autofocus/>
                                                        @if($errors->has('city'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('city') }}</strong>
                                                            </span>
                                                        @endif
                                                    <label for="inputCity">@lang('global.city')</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="file" class="custom-file-input{{ $errors->has('picture') ? ' is-invalid' : ''}}"
                                            id="avatar" name="avatar"/>
                                        <label class="custom-file-label" for="picture">
                                                {{ __("Escoge una imagen para tu curso") }}
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" value="{{ old('password') ?: $user->password }}" required readonly>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            <label for="inputPassword">@lang('global.password')</label>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-label-group">
                                            <input type="password" id="confirmPassword" class="form-control"
                                            name="password_confirmation" value="{{ old('password') ?: $user->password }}" required readonly>
                                            <label for="confirmPassword">@lang('global.confirmpassword')</label>
                                        </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="allowupdatepassword" >@lang('global.updatepassword')</button>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-lg">@lang('global.update')</button>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row justify-content-center">
                            <div class="profile-header-container">
                                <div class="profile-header-img my-3">
                                    @if(auth()->user()->avatar != 'user.jpg')
                                        <img class="rounded-circle" src="/storage/avatars/{{ $user->avatar }}" />
                                    @else
                                        <i class="fas fa-user-circle fa-fw"></i>
                                    @endif
                                    <!-- badge -->
                                    <div class="rank-label-container text-center text-primary font-weight-bold my-3">
                                        <span class="label label-default rank-label">{{$user->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
 <script>
     window.addEventListener('DOMContentLoaded', function(){
        var button = document.querySelector("#allowupdatepassword");

        button.addEventListener('click',function(){
			document.getElementById("inputPassword").removeAttribute("readonly");
            document.getElementById("confirmPassword").removeAttribute("readonly");
            document.getElementById("inputPassword").removeAttribute("value");
            document.getElementById("confirmPassword").removeAttribute("value");
		});



    });

 </script>

@endpush






