<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rakija Shop</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/js/app.js'])

</head>

<body class="siteBody">
    <x-validation.pop-up-window msg="{{ session ('success') }}" type="success" />
    @include('components.header.nav')
    <main class="siteMain">
        @yield('main')
    </main>
    <x-footer.footer />
    {{-- @vite('resources/js/jQuery.js') --}}
    @vite('resources/js/script.js')
</body>

</html>