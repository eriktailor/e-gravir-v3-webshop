<div>
    <div class="flex items-center justify-between mb-2">
        <x-heading level="h3">Kosaram</x-heading>
        <x-button.chip icon="x" class="dropdown-close"/>
    </div>
    @if(count(session('cart', [])))
        <p class="text-gray-400 mb-4 pb-4 border-b border-gray-300 text-sm">
            A kosárban lévő termékeket a következő oldalon tudod majd személyre szabni.
        </p>
    @endif
    @forelse(session('cart', []) as $id => $item)
        @for($i = 0; $i < $item['quantity']; $i++)
            <div class="cart-item flex gap-x-4 border-b border-gray-300 mb-4 pb-4">
                <div class="relative w-16 h-16 flex-none">
                    <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" 
                        alt="{{ $item['name'] }}" 
                        class="w-full h-full object-cover rounded-lg" />
                </div>            
                <div class="flex flex-col grow text-sm">
                    <div class="flex justify-between flex-nowrap">
                        <x-heading level="h5" class="mb-1.5 mr-3">
                            {{ $item['name'] }}
                        </x-heading>
                        <x-tooltip text="Törlés">
                            <x-button.chip 
                                icon="trash" 
                                class="remove-cart-item -mt-2.5"
                                type="button"
                                data-id="{{ $id }}"
                            />
                        </x-tooltip>
                    </div>
                    <span class="text-sm font-normal">
                        {{ $item['price'] }} Ft
                    </span>
                </div>           
            </div>
        @endfor
    @empty
        <div class="flex flex-col items-center gap-y-6">
            <img class="px-8 -mt-3" src="{{ asset('/img/empty_cart.png') }}" alt="Üres kosár">
            <p>Jelenleg nincs termék a kosaradban.</p>
            <x-button href="{{ route('webshop.home') }}">Vásárlás Folytatása</x-button>
        </div>
    @endforelse

    <div class="cart-footer flex-none {{ count(session('cart', [])) ? '' : 'hidden' }}">
        <x-heading level="h4" class="flex justify-between mb-3">
            <span>Összesen:</span>
            <span class="font-normal">{{ number_format(cart_total(), 0, ',', ' ') }} Ft</span>
        </x-heading>
        <x-button href="{{ route('webshop.cart') }}" class="w-full">
            Testreszabás
        </x-button>
    </div>

    {{-- Remove item from cart form --}}
    <form method="POST" action="{{ route('cart.remove') }}" id="removeCartItemForm" class="hidden">
        @csrf
        <input type="hidden" name="cart_item_id" id="removeCartItemId">
    </form>

</div>

@push('scripts')
    <script>
        document.querySelectorAll('.remove-cart-item').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                document.getElementById('removeCartItemId').value = id;
                document.getElementById('removeCartItemForm').submit();
            });
        });
    </script>
@endpush
