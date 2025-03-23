<aside id="sideCart" class="nav-cart fixed inset-0 z-50 invisible opacity-0 transition-opacity duration-300" data-cart-count="{{ count(session('cart', [])) }}">

    <!-- BACKDROP -->
    <div id="cartBackdrop" class="absolute inset-0 bg-stone-950/50 opacity-0 transition-opacity duration-300"></div>

    <!-- CART PANEL -->
    <div id="cartPanel" class="absolute right-0 top-0 h-full w-full sm:w-[500px] transform translate-x-full transition-transform duration-300 ease-in-out p-8">
        <div class="bg-white rounded-xl h-full flex flex-col">

            <!-- Cart Header -->
            <div class="cart-header p-6 border-b border-gray-300 flex-none">
                <div class="flex justify-between">
                    <x-heading level="h2">Kosaram</x-heading>
                    <x-button.chip icon="x" class="close-cart"/>
                </div>
                @if(count(session('cart', [])))
                    <p class="text-gray-400 mt-3">A kosárban lévő termékeket a pénztár oldalon tudod majd személyre szabni.</p>
                @endif
            </div>

            <!-- Cart Content -->
            <div class="cart-content flex-grow overflow-auto no-scrollbar">
                
                @forelse(session('cart', []) as $id => $item)
                    @for($i = 0; $i < $item['quantity']; $i++)
                        <div class="cart-item flex gap-x-4 p-6 border-b border-gray-300">
                            <div class="relative w-18 h-18 flex-none">
                                <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" 
                                    alt="{{ $item['name'] }}" 
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>            
                            <div class="flex flex-col grow">
                                <div class="flex justify-between flex-nowrap">
                                    <x-heading level="h4" class="mb-2 mr-3">
                                        {{ $item['name'] }}
                                    </x-heading>
                                    <x-button.chip icon="trash" class="remove-cart-item flex-none h-9 -mt-2 -mr-2" data-id="{{ $id }}"/>
                                </div>
                                <div class="flex justify-between">
                                    <a class="text-sm text-red-600 underline underline-offset-2 hover:no-underline">
                                        Testreszabás
                                    </a>
                                    <span class="text-sm text-gray-400">
                                        {{ $item['price'] }} Ft
                                    </span>
                                </div>
                            </div>           
                        </div>
                    @endfor
                @empty
                    <div class="flex flex-col items-center gap-y-6">
                        <img class="px-8" src="{{ asset('/img/empty_cart.png') }}" alt="Üres kosár">
                        <p>Jelenleg nincs termék a kosaradban.</p>
                        <x-button href="{{ route('webshop.home') }}">Vásárlás Folytatása</x-button>
                    </div>
                @endforelse
            </div>

            <!-- Cart Footer -->
            <div class="cart-footer flex-none p-6 {{ count(session('cart', [])) ? '' : 'hidden' }}">
                <x-heading level="h4" class="flex justify-between mb-3">
                    <span>Összesen:</span>
                    <span class="font-normal">{{ number_format(cart_total(), 0, ',', ' ') }} Ft</span>
                </x-heading>
                <x-button href="{{ route('webshop.checkout') }}" class="w-full">Tovább a Megrendeléshez</x-button>
            </div>
            

        </div>
    </div>
</aside>