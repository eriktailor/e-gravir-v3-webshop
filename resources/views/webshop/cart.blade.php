@extends('layouts.shop')

@section('title', 'Testreszabás')

@section('content')

    <x-header.page :title="'Testreszabás'"/>

    <main class="pb-24">
        <div class="container">
            <form action="{{ route('cart.customizations.store') }}" method="POST" id="productCustomizeForm" enctype="multipart/form-data" novalidate>
                @csrf
            
                <div class="flex flex-col gap-y-6 max-w-3xl mx-auto">
                    <p class="text-lg max-w-xl mx-auto text-center">Ezen az oldalon tudod személyre szabni a kosaraban lévő termékeket. Kattints a "Testreszabás" gombra a termékeknél.</p>
                    @forelse($cart as $cartItemId => $item)
                        @for($i = 0; $i < $item['quantity']; $i++)
                            <div class="cart-item bg-white rounded-xl shadow">
                                <div class="flex items-center justify-between gap-x-4 p-6">
                                    <div class="flex items-center gap-x-3">
                                        <div class="relative w-18 h-18 flex-none">
                                            <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" 
                                                alt="{{ $item['name'] }}" 
                                                class="w-full h-full object-cover rounded-lg" />
                                        </div>
                                        <div>
                                            <x-heading level="h4" class="mb-1">{{ $item['name'] }}</x-heading>
                                            <p>{{ $item['price'] }} Ft </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-x-3">
                                        <x-button type="button" color="white" class="toggle" data-target="#productCustomizeBlock-{{ $loop->index }}">
                                            Testreszabás
                                        </x-button>
                                        <x-tooltip text="Törlés">
                                            <x-button.chip 
                                                icon="trash" 
                                                class="remove-cart-item flex-none h-9 -mt-2 -mr-2"
                                                type="button"
                                                data-id="{{ $cartItemId }}"/>
                                        </x-tooltip>
                                    </div>
                                </div>
                                <div class="hidden p-6 border-t border-gray-300" id="productCustomizeBlock-{{ $loop->index }}">

                                    @php
                                        $productId = $item['product_id'];
                                        $custom = $customizations[$productId] ?? null;
                                    @endphp
                                    <input type="hidden" name="cart_item_id" value="{{ $cartItemId }}" />
                                    
                                    {{-- Előlap mezők --}}
                                    <div class="flex flex-col gap-y-4">
                                        @if($custom?->front_image)
                                            <div class="form-group">
                                                <x-form.upload for="customizations[{{ $cartItemId }}][front_image]" id="customizeFrontImage-{{ $loop->index }}" label="Előlap képe"/>
                                            </div>
                                        @endif
                                        @if($custom?->front_text)
                                            <div class="form-group">
                                                <x-form.input for="customizations[{{ $cartItemId }}][front_text]" id="customizeFrontText-{{ $loop->index }}" label="Előlap szöveg"/>
                                            </div>
                                        @endif
                                        @if($custom?->other_notes)
                                            <div class="form-group">
                                                <x-form.textarea for="customizations[{{ $cartItemId }}][other_notes]" id="customizeOtherNotes-{{ $loop->index }}" label="Egyéb instrukció" rows="4"/>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @php
                                        $engraveSecond = $item['customization']['engrave_second'] ?? false;
                                        $engraveThird = $item['customization']['engrave_third'] ?? false;
                                    @endphp

                                    {{-- Extra gravírozás mezők --}}
                                    <div class="flex flex-col gap-4 mt-4">

                                        <x-form.checkbox 
                                            for="engrave_second_page_{{ $cartItemId }}" 
                                            name="customizations[{{ $cartItemId }}][engrave_second_page]"
                                            :checked="$engraveSecond">
                                            A hátoldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                                        </x-form.checkbox>

                                        <x-form.checkbox 
                                            for="engrave_third_page_{{ $cartItemId }}" 
                                            name="customizations[{{ $cartItemId }}][engrave_third_page]"
                                            :checked="$engraveThird">
                                            A belső oldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                                        </x-form.checkbox>

                                    </div>

                                </div>
                            </div>
                        @endfor
                    @empty
                        <div class="flex flex-col items-center gap-y-6">
                            <img class="px-8" src="{{ asset('img/empty_cart.png') }}" alt="Üres kosár">
                            <p>Jelenleg nincs termék a kosaradban.</p>
                            <x-button href="{{ route('webshop.home') }}">Vásárlás Folytatása</x-button>
                        </div>
                    @endforelse   
                    <div class="flex justify-center">
                        <x-button type="submit">Mentés és tovább a megrendeléshez</x-button>
                    </div>
                </div>

            </form>

            {{-- Remove item from cart form --}}
            <form method="POST" action="{{ route('cart.remove') }}" id="removeCartItemForm" class="hidden">
                @csrf
                <input type="hidden" name="cart_item_id" id="removeCartItemId">
            </form>

        </div>
    </main>

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.remove-cart-item').forEach(button => {
            button.addEventListener('click', function () {
                const cartItemId = this.dataset.id;
                const form = document.getElementById('removeCartItemForm');
                document.getElementById('removeCartItemId').value = cartItemId;
                form.submit();
            });
        });
    </script>
@endpush