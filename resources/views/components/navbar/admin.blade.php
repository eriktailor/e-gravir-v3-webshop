<nav class="navbar bg-stone-950 sticky top-0 z-40 py-3 md:py-4 relative">
    <div class="container">
        <div class="flex justify-between items-center">
            <div class="flex-none w-28">
                <a class="no-underline flex gap-x-2" href="/admin">
                    <img src="{{ asset('/img/logos/logo_emblem.svg') }}" alt="E-Gravír Admin" width="25" height="25">
                    <span class="text-white font-bold text-xl">Admin</span>
                </a>
            </div>
            <div class="navbar-menu hidden md:flex md:flex-row gap-3 absolute md:relative top-[60px] md:top-0 left-0 bg-stone-950 w-full md:w-auto px-2.5 pb-3 md:pb-0">
                <a href="{{ route('products.index') }}">Termékek</a>
                <a href="{{ route('categories.index') }}">Kategóriák</a>
                <a href="#">Rendelések</a>
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