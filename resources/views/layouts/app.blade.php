<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Agenda Personal</title>

    <meta name="robots" content="noindex,follow" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')


</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('navbar')

            @hasSection('content')
                <div id="wrapper">

                    @yield('sidebar')

                    @yield('content')

                </div>
            @else
                @yield('welcome')
            @endif

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="">
              <i class="fas fa-angle-up"></i>
            </a>
        </main>
    </div>
    <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')

</body>

</html>
