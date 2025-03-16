<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head/>
    <body class="admin">

        <x-navbar.admin/>
        
        {{-- <x-success-fullwidth/> --}}
        
        @yield('content')

        @stack('scripts')

        @vite('resources/js/app.js')
        
    </body>
</html>