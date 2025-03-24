<x-navbar.topbar/>

<nav class="navbar bg-stone-950 sticky top-0 z-40 py-3 md:py-4">
    <div class="container">
        <div class="flex justify-between items-center">
            <div class="flex-none w-28">
                <a class="no-underline flex gap-x-2" href="/admin">
                    <img src="{{ asset('/img/logos/logo_emblem.svg') }}" alt="E-Gravír Admin" width="25" height="25">
                    <span class="text-white font-semibold tracking-tight text-xl">Admin</span>
                </a>
            </div>
            <div class="navbar-menu hidden md:flex md:flex-row gap-3 absolute md:relative top-[60px] md:top-0 left-0 bg-stone-950 w-full md:w-auto px-2.5 pb-3 md:pb-0">
                @php
                    $menu_item_class = 'block w-full md:w-auto rounded-md py-1 px-2 text-gray-400 hover:text-white hover:bg-white/15';
                    $active_class = 'bg-white/15 text-white';
                @endphp
                <a class="{{ $menu_item_class }} {{ request()->routeIs('categories.index') ? $active_class : '' }}" href="{{ route('categories.index') }}">
                    Kategóriák
                </a>
                <a class="{{ $menu_item_class }} {{ request()->routeIs('products.index') ? $active_class : '' }}" href="{{ route('products.index') }}">
                    Termékek
                </a>
                <a class="{{ $menu_item_class }} {{ request()->routeIs('orders.index') ? $active_class : '' }}" href="{{ route('orders.index') }}">
                    Rendelések
                </a>
            </div>
            <div class="flex md:flex-none justify-end w-28 gap-x-3">
                <button class="navbar-toggle md:hidden">
                    <x-icon name="align-right" class="text-gray-400 w-7 h-7"/>
                </button>
                <x-dropdown>
                    <x-slot name="trigger">
                        <img class="rounded-full w-9 h-9 md:ml-auto" src="{{ Auth::user()->image }}" alt="{{ Auth::user()->name }}">
                    </x-slot>
                    <a href="#">Profilom</a>
                    <a href="#">Beállítások</a>
                    <a href="#">Kijelentkezés</a>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

@once('navbar')
    @push('scripts')
        <script>
            /**
             * Navbar toggle nav menu on mobile
             */
            $(document).ready(function() {
                $('.navbar-toggle').on('click', function() {
                    $(this).closest('.navbar').find('.navbar-menu').slideToggle(300);
                });
            });
        </script>
    @endpush
@endonce
