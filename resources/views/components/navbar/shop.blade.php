<x-navbar.topbar/>

<nav class="navbar bg-stone-950 sticky top-0 z-40 py-3 md:py-4">
    <div class="container">
        <div class="flex justify-between items-center">
            <div class="flex-none">
                <a class="no-underline flex gap-x-2" href="/admin">
                    <img src="{{ asset('/img/logos/logo_emblem.svg') }}" alt="E-Gravír Logó" width="25" height="25">
                    <span class="text-white font-semibold tracking-tight text-xl whitespace-nowrap">E-Gravír</span>
                </a>
            </div>
            <div class="navbar-menu flex flex-row gap-3 bg-stone-950">
                @php
                    $categories = App\Models\ProductCategory::all();
                @endphp
                @foreach($categories as $category)
                    <a href="{{ '/webshop/' . $category->slug }}">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="flex md:flex-none justify-end w-18 gap-x-3">
                <button class="navbar-toggle md:hidden">
                    <x-icon name="align-right" class="text-gray-400 w-7 h-7"/>
                </button>
                <div class="relative">
                    <button class="cart-toggle cursor-pointer p-2 transition-all">
                        <svg class="text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path> <line x1="3" y1="6" x2="21" y2="6"></line> <path d="M16 10a4 4 0 0 1-8 0"></path> </svg>
                    </button>
                    <div class="cart-count absolute top-1 right-0.5 bg-red-600 text-white text-xs font-medium rounded-full w-4 h-4 flex text-center items-center justify-center">0</div>
                </div>
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
