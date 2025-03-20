<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head/>
    <body class="frontend"> 

        <x-loader/>   

        <x-navbar.shop/>

        @yield('content')

        @stack('scripts')
        
        @vite('resources/js/app.js')
        
    </body>
</html>