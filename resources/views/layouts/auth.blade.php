<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head/>
    <body class="auth flex"> 

        <x-loader/>   

        <div class="w-full md:w-1/2 min-h-screen">
            <div class="container h-full flex justify-center items-center">
                @yield('content')
            </div>
        </div>

        <div class="w-1/2 h-screen hidden md:block">
            <img class="w-full h-full object-cover" src="{{ asset('/img/backgrounds/login_bg.webp') }}" alt="Belépés">
        </div>

        @vite('resources/js/app.js')
        
    </body>
</html>