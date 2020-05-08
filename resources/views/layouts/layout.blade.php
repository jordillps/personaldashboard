<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reservar Cita</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700|Montserrat&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="/css/styles.css">
        <link rel="stylesheet" href="/css/app_reservation.css">

        @stack('styles')
    </head>


    <body class='reservation-page'>
        @yield('content')

        @stack('scripts')
    </body>
</html>
