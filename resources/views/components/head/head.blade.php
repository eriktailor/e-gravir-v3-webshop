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

    <!-- jQuery Cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>