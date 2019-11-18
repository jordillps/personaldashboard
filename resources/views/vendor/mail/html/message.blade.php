@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{-- {{ config('app.name') }} --}}
            {{__('Personal Dashboard')}}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            {{-- © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.') --}}
            © {{ date('Y') }} {{ __('Personal Dashboard') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
