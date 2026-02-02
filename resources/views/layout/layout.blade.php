<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rakija Shop</title>

</head>

<body>
    @include('components.header.nav')
    <main>
        @yield('main')
    </main>
    @vite(['resources/js/app.js'])
</body>

</html>