<aside class="nav-cart w-full h-screen fixed top-0 right-0 z-50" id="navCart">
    <div class="bg-stone-950/50 absolute left-0 top-0 w-full h-full z-50"></div>
    <div class="absolute p-8 right-0 top-0 z-50 h-full">
        <div class="bg-white h-full w-full sm:w-[500px] rounded-xl">
            <div class="cart-header p-8 flex justify-between">
                <x-heading level="h2">Kosaram</x-heading>
                <x-button.chip icon="x"/>
            </div>
            <div class="cart-content h-[calc(100%-100px)] flex justify-center">
                @forelse(session('cart', []) as $id => $item)
                    <div class="border-b mb-4 pb-2">
                        <p>{{ $item['name'] }}</p>
                        <p>{{ $item['price'] }} Ft x {{ $item['quantity'] }}</p>
                    </div>
                @empty
                    <div class="flex flex-col items-center gap-y-6">
                        <img class="px-8 -mt-8" src="{{ asset('/img/empty_cart.png') }}" alt="Üres kosár">
                        <p>Jelenleg nincs termék a kosaradban.</p>
                        <x-button href="{{ route('webshop.home') }}">Vásárlás Folytatása</x-button>
                    </div>
                @endforelse
            </div>
            <div class="cart-footer">

            </div>
        </div>
    </div>
    
</aside>