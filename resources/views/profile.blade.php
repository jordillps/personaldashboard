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
                                    <strong>@lang($message)</strong>
                                </div>
                            @endif
                            <form form method="POST" action="{{ route('home.profile.update') }}" novalidate enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <div class="form-label-group">
                                                <input  id="inputName" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                name="name" value="{{ old('name') ?: $user->name }}" autofocus/>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <label for="inputName">@lang('global.firstname')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <div class="form-label-group">
                                                    <input  id="inputEmail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    name="email" value="{{ old('email') ?: $user->email }}" autofocus/>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <label for="inputEmail">@lang('global.emailaddress')</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-label-group">
                                                    <input  id="inputPhone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    name="phone" value="{{ old('phone') ?: $user->phone }}" autofocus/>
                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <label for="inputPhone">@lang('global.telephone')</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-label-group">
                                                    <input  id="inputBirthDate" type="date" class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}"
                                                    name="birthdate" value="{{ old('birthdate') ?: $user->birthdate }}" autofocus/>
                                                    @error('birthdate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <label for="inputBirthDate">@lang('global.birthdate')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <div class="form-label-group">
                                                    <input  id="inputPostalCode" type="text" class="form-control{{ $errors->has('postalcode') ? ' is-invalid' : '' }}"
                                                    name="postalcode" value="{{ old('postalcode') ?: $user->postalcode }}" autofocus/>
                                                    @error('postalcode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <label for="inputPostalCode">@lang('global.postalcode')</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-label-group">
                                                    <input  id="inputCity" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                                    name="city" value="{{ old('city') ?: $user->city }}" autofocus/>
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                <label for="inputCity">@lang('global.city')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <div class="form-label-group">
                                                <input type="file" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : ''}}"
                                                    id="avatar" name="avatar" lang="es"/>
                                                @if($errors->has('avatar'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('avatar') }}</strong>
                                                    </span>
                                                @else
                                                    <span> 
                                                        @lang('global.imagevalidation')
                                                    </span> 
                                                @endif                                                    
                                                <label for="avatar">
                                                    @lang('global.imageprofile')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                        <div class="form-label-group">
                                            <input type="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            <label for="inputPassword">@lang('global.password')</label>
                                        </div>
                                        </div>
                                        <div class="col-lg-6">
                                        <div class="form-label-group">
                                            <input type="password" id="confirmPassword" class="form-control"
                                            name="password_confirmation" >
                                            <label for="confirmPassword">@lang('global.confirmpassword')</label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p>GOOGLE CALENDAR</p>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-lg-4">
                                            <div class="form-label-group">
                                                <input  id="inputGoogleCalendarId" type="text" class="form-control{{ $errors->has('googlecalendarid') ? ' is-invalid' : '' }}"
                                                name="googlecalendarid" value="{{ old('googlecalendarid') ?: $user->googlecalendarid }}" autofocus/>
                                                @if($errors->has('googlecalendarid'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('googlecalendarid') }}</strong>
                                                    </span>
                                                @endif
                                                <label for="inputGoogleCalendarId">@lang('global.googlecalendarid')</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-label-group">
                                                <input  id="inputGoogleCalendarApiKey" type="text" class="form-control{{ $errors->has('googlecalendarapikey') ? ' is-invalid' : '' }}"
                                                name="googlecalendarapikey" value="{{ old('googlecalendarapikey') ?: $user->googlecalendarapikey }}" autofocus/>
                                                @if($errors->has('googlecalendarapikey'))
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('googlecalendarapikey') }}</strong>
                                                    </span>
                                                @endif
                                                <label for="inputCity">@lang('global.googlecalendarapikey')</label>
                                            </div>
                                        </div>
                                    </div>
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
                                    @if($user->avatar == 0)
                                        <img class="rounded-circle img-thumbnail" height="200" width="200" src="/images/avatar-icon.png" />
                                    @else
                                        <img class="rounded-circle img-thumbnail" height="200" width="200" src="/storage/avatars/{{ $user->avatar }}" />
                                    @endif

                                    <!-- badge -->
                                    <div class="rank-label-container text-center font-weight-bold my-3">
                                        <span class="label label-default rank-label">{{$user->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
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

        
@endpush








