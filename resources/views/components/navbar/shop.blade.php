<x-navbar.topbar/>

<nav class="navbar bg-stone-950 sticky top-0 z-40 py-2.5 lg:py-4">
    <div class="container">
        <div class="flex justify-between items-center">
            <div class="flex-none">
                <a class="no-underline flex gap-x-2 group" href="{{ route('webshop.home') }}">
                    <img src="{{ asset('/img/logos/logo_emblem.svg') }}" alt="E-Gravír Logó" width="25" height="25">
                    <span class="text-white group-hover:text-gray-200 transition font-semibold tracking-tight text-xl whitespace-nowrap">E-Gravír</span>
                </a>
            </div>
            <div class="navbar-menu hidden absolute top-[60px] lg:top-0 left-0 w-full lg:w-auto px-2 pb-5 lg:p-0 lg:relative lg:flex flex-row gap-3 bg-stone-950">
                @php
                    $categories = App\Models\ProductCategory::all();
                @endphp
                @foreach($categories as $category)
                    <a class="block w-full md:w-auto rounded-md p-2 lg:py-1 text-gray-400 hover:text-white hover:bg-white/15" href="{{ '/webshop/' . $category->slug }}">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="flex items-center lg:flex-none justify-end w-18">            
                <button class="navbar-toggle lg:hidden pl-2 pr-1">
                    <x-icon name="align-right" class="text-gray-400 w-7 h-7"/>
                </button>
                <div class="relative">                        
                    <a 
                        class="offcanvas-toggle cursor-pointer p-2 transition-all text-gray-500 hover:text-gray-300 block" 
                        id="cartToggle" 
                        href="#sideCart"
                        {{ request()->routeIs('webshop.checkout') ? 'disabled' : '' }}>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path> <line x1="3" y1="6" x2="21" y2="6"></line> <path d="M16 10a4 4 0 0 1-8 0"></path> </svg>
                    </a>
                    <div class="cart-count absolute top-0 right-0 bg-red-600 text-white text-xs font-medium rounded-full w-4 h-4 flex text-center items-center justify-center pointer-events-none">
                        {{ collect(session('cart', []))->sum('quantity') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

@include('webshop.cart')

@push('scripts')
    <script>
        /**
         * Navbar toggle nav menu on mobile
         */
        $(document).ready(function() {
            $('.navbar-toggle').on('click', function() {
                $(this).closest('.navbar').find('.navbar-menu').slideToggle(200);
            });
        });
    </script>
@endpush
