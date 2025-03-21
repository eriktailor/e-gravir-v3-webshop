<aside id="sideCart" class="nav-cart fixed inset-0 z-50 invisible opacity-0 transition-opacity duration-300">

    <!-- BACKDROP -->
    <div id="cartBackdrop" class="absolute inset-0 bg-stone-950/50 opacity-0 transition-opacity duration-300"></div>

    <!-- CART PANEL -->
    <div id="cartPanel" class="absolute right-0 top-0 h-full w-full sm:w-[500px] transform translate-x-full transition-transform duration-300 ease-in-out p-8">
        <div class="bg-white rounded-xl h-full">
            <div class="cart-header p-8 border-b border-gray-300">
                <div class="flex justify-between">
                    <x-heading level="h2" class="mb-3">Kosaram</x-heading>
                    <x-button.chip icon="x" class="close-cart"/>
                </div>
                @if(count(session('cart', [])))
                    <p>A kosárban lévő termékeket a pénztár oldalon tudod majd személyre szabni.</p>
                @endif
            </div>
            <div class="cart-content h-[calc(100%-100px)] flex flex-col gap-y-3 p-8">
                
                @forelse(session('cart', []) as $id => $item)
                    <div class="cart-item flex gap-x-3">
                        <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg" />
                        <div class="w-4/5">
                            <x-heading level="h4" class="leading-tight mb-1.5">{{ $item['name'] }}</x-heading>
                            <p class="font-normal text-sm">{{ $item['price'] }} Ft x {{ $item['quantity'] }}</p>
                        </div>
                        <div class="flex-none">
                            <x-button.chip icon="trash" class="remove-cart-item -mt-2.5" data-id="{{ $id }}"/>
                        </div>
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
