<head>

    <!-- Base metas -->
    <x-head.base-metas/>

    <!-- Page title -->
    <title>@yield('title') | {{ env('APP_NAME', 'E-Gravír') }}</title>
    
    <!-- Other metas -->
    @yield('metas')
    <x-head.social-metas/>
    
    <!-- Favicons -->
    <x-head.favicons/>

    <!-- Stylesheet -->
    @stack('styles')
    @vite('resources/css/app.css')

    <!-- Barion Pixel -->
    {{-- <x-head.barion-pixel/> --}}

    <!-- Meta pixel -->
    <x-head.meta-pixel/>

</head>