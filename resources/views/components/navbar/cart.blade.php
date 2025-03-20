<aside id="sideCart" class="nav-cart fixed inset-0 z-50 invisible opacity-0 transition-opacity duration-300">

    <!-- BACKDROP -->
    <div id="cartBackdrop" class="absolute inset-0 bg-stone-950/50 opacity-0 transition-opacity duration-300"></div>

    <!-- CART PANEL -->
    <div id="cartPanel" class="absolute right-0 top-0 h-full w-full sm:w-[500px] transform translate-x-full transition-transform duration-300 ease-in-out p-8">
        <div class="bg-white rounded-xl h-full p-8">
            <div class="cart-header flex justify-between">
                <x-heading level="h2">Kosaram</x-heading>
                <x-button.chip icon="x" class="close-cart"/>
            </div>
            <div class="cart-content h-[calc(100%-100px)] flex justify-center">
                @forelse(session('cart', []) as $id => $item)
                    <div class="border-b mb-4 pb-2">
                        <p>{{ $item['name'] }}</p>
                        <p>{{ $item['price'] }} Ft x {{ $item['quantity'] }}</p>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-y-6">
                        <img class="px-8" src="{{ asset('/img/empty_cart.png') }}" alt="Üres kosár">
                        <p>Jelenleg nincs termék a kosaradban.</p>
                        <x-button href="{{ route('webshop.home') }}">Vásárlás Folytatása</x-button>
                    </div>
                @endforelse
            </div>
            <div class="cart-footer"></div>
        </div>
    </div>

</aside>
