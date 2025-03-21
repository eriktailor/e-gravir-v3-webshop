<aside id="sideCart" class="nav-cart fixed inset-0 z-50 invisible opacity-0 transition-opacity duration-300">

    <!-- BACKDROP -->
    <div id="cartBackdrop" class="absolute inset-0 bg-stone-950/50 opacity-0 transition-opacity duration-300"></div>

    <!-- CART PANEL -->
    <div id="cartPanel" class="absolute right-0 top-0 h-full w-full sm:w-[500px] transform translate-x-full transition-transform duration-300 ease-in-out p-8">
        <div class="bg-white rounded-xl h-full">
            <div class="cart-header p-6 border-b border-gray-300">
                <div class="flex justify-between">
                    <x-heading level="h2" class="mb-3">Kosaram</x-heading>
                    <x-button.chip icon="x" class="close-cart"/>
                </div>
                @if(count(session('cart', [])))
                    <p class="text-gray-400">A kosárban lévő termékeket a pénztár oldalon tudod majd személyre szabni.</p>
                @endif
            </div>
            <div class="cart-content h-[calc(100%-100px)]">
                
                @forelse(session('cart', []) as $id => $item)
                    <div class="cart-item flex gap-x-4 p-6 border-b border-gray-300">
                        <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" 
                            alt="{{ $item['name'] }}" 
                            class="w-18 h-18 object-cover rounded-lg" />
                        <div class="w-4/5">
                            <x-heading level="h4" class="mb-2">
                                {{ $item['name'] }}
                            </x-heading>
                            <p class="text-sm text-gray-400">
                                {{ $item['price'] }} Ft {{ $item['quantity'] > 1 ? 'x ' . $item['quantity'] : '' }}
                            </p>
                        </div>
                        <div class="flex-none">
                            <x-button.chip icon="trash" class="remove-cart-item -mt-2" data-id="{{ $id }}"/>
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
