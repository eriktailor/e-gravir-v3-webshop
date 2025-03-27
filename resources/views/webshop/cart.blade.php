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
                                            <x-button.chip icon="trash" 
                                                class="remove-cart-item flex-none h-9 -mt-2 -mr-2" 
                                                data-id="{{ $item['product_id'] }}"
                                                type="submit"/>
                                        </x-tooltip>
                                    </div>
                                </div>
                                <div class="hidden p-6 border-t border-gray-300" id="productCustomizeBlock-{{ $loop->index }}">

                                    @php
                                        $productId = $item['product_id'];
                                        $custom = $customizations[$productId] ?? null;
                                    @endphp
                                    <input type="hidden" name="cart_item_id" value="{{ $cartItemId }}" />

                                    @if($custom?->front_image)
                                        <div class="form-group">
                                            <x-form.upload for="customizations[{{ $cartItemId }}][front_image]" label="Előlap képe"/>
                                        </div>
                                    @endif
                                    @if($custom?->front_text)
                                        <div class="form-group">
                                            <x-form.input for="customizations[{{ $cartItemId }}][front_text]" label="Előlap szöveg"/>
                                        </div>
                                    @endif
                                    @if($custom?->other_notes)
                                        <div class="form-group">
                                            <x-form.textarea for="customizations[{{ $cartItemId }}][other_notes]" label="Egyéb instrukció" rows="4"/>
                                        </div>
                                    @endif
                
                                    <x-form.checkbox 
                                        for="customizations[{{ $cartItemId }}][engrave_second_page]" 
                                        class="toggle"
                                        data-target="#customizeBackPage">
                                        A hátoldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                                    </x-form.checkbox>
                                    <div class="hidden" id="customizeBackPage">
                                        @if($custom?->back_image)
                                            <div class="form-group mb-4">
                                                <x-form.upload for="customizations[{{ $cartItemId }}][back_image]" label="Hátlap képe"/>
                                            </div>
                                        @endif
                                        @if($custom?->back_text)
                                            <div class="form-group">
                                                <x-form.input for="customizations[{{ $cartItemId }}][front_text]" label="Hátlap szöveg"/>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <x-form.checkbox 
                                        for="customizations[{{ $cartItemId }}][engrave_inner_page]" 
                                        class="toggle"
                                        data-target="#customizeInnerPage">
                                        A belső oldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                                    </x-form.checkbox>
                                    <div class="hidden" id="customizeInnerPage">
                                        @if($custom?->inner_text)
                                            <div class="form-group">
                                                <x-form.input for="customizations[{{ $cartItemId }}][inner_text]" label="Belső szöveg"/>
                                            </div>
                                        @endif
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
                    <x-button type="submit">Mentés és tovább a megrendeléshez</x-button>
                </div>

            </form>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        document.getElementById('submitAllCustomizations').addEventListener('click', function(e) {
            e.preventDefault();

            const masterForm = document.getElementById('customizationsMasterForm');
            const allForms = document.querySelectorAll('form[id^="productCustomizeForm-"]');

            // ürítsük ki a masterFormot (ha újrapróbáljuk)
            masterForm.innerHTML = `@csrf`;

            allForms.forEach(form => {
                const formData = new FormData(form);

                for (let [key, value] of formData.entries()) {
                    // Tömbösítjük a mezőket: name[cartItemId][mező]
                    const cartItemId = form.querySelector('input[name="cart_item_id"]').value;

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `${cartItemId}[${key}]`;
                    input.value = value;
                    masterForm.appendChild(input);
                }
            });

            masterForm.submit();
        });
    </script>
@endpush