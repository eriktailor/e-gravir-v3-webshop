<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head/>
    <body class="admin">

        {{-- <x-navbar id="navbar">
            <div class="flex items-center gap-x-3">
                <a class="modal-trigger link-none text-white/70 hover:text-white hover:underline underline-offset-2" href="#barionLinkModal">Barion Link</a>
                <a class="modal-trigger link-none text-white/70 hover:text-white hover:underline underline-offset-2" href="#adminStockModal">Készlet</a>
                <a class="link-none text-white/70 hover:text-white hover:underline underline-offset-2" href="{{ route('admin.logout') }}">Kilépés</a>
                <img class="rounded-full w-9 h-9" src="{{ Auth::user()->image }}" alt="{{ Auth::user()->name }}">
            </div>
        </x-navbar> --}}

        <nav class="bg-stone-950 sticky top-0 z-40 py-4">
            <div class="container">
                <div class="flex justify-between items-center">
                    <a class="no-underline flex gap-x-2" href="/admin">
                        <img src="{{ asset('/img/logos/logo_emblem.svg') }}" alt="E-Gravír Admin" width="25" height="25">
                        <span class="text-white font-bold text-xl">Admin</span>
                    </a>
                   
                </div>
            </div>
        </nav>
        

        {{-- <x-success-fullwidth/> --}}
        
        <header class="py-16">
            <div class="container">
                <div class="flex justify-between items-center">
                    <h1 class="text-5xl">@yield('title')</h1>
                    <x-button>Mentés</x-button>
                </div>
            </div>
        </header>
        
        @yield('content')

        @stack('scripts')

        @vite('resources/js/app.js')
        
    </body>
</html>