<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rakija Shop</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    @include('components.header.nav')
    @yield('main')

    @vite(['resources/js/app.js'])
    {{-- @vite('resources/js/jQuery.js') --}}
    @vite('resources/js/script.js')
</body>

</html>