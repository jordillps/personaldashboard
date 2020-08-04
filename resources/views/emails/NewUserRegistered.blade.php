{{-- //Els components que podem utilitzar estan a
//vendor html/text/message --}}

@component('mail::message')
{{-- //# es del llenguatge markdown --}}
# @lang('global.newuserregisterd')<br><br>
@lang('global.namenewuser'):<br>
{{ $user_name}}<br><br>
@lang('global.emailnewuser'):<br>
{{ $user_email}}<br><br><br>

{{-- @component('mail::button', ['url' => url('/tables/'), 'color' => 'blue'])
    {{ __('Ir al listado') }}
@endcomponent --}}

@lang('global.thanks'),<br>
{{ __('Personal Dashboard') }}

@endcomponent
