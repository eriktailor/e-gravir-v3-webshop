<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head/>
    <body class="admin">

        <x-loader/>  
        
        <x-navbar.admin/>
                
        @yield('content')

        <x-footer.admin/>

        @stack('scripts')

        @vite('resources/js/app.js')
        
    </body>
</html>