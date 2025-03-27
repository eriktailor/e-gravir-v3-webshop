@extends('layouts.shop')

@section('title', 'Testreszabás')

@section('content')

    <x-header.page :title="'Testreszabás'"/>

    <main>
        <div class="container">
            <div class="flex flex-col gap-y-6 max-w-3xl mx-auto">
                <p class="text-lg max-w-xl mx-auto text-center">Ezen az oldalon tudod személyre szabni a kosaraban lévő termékeket. Kattints a "Testreszabás" linkre a termékeknél alább!</p>
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
                                        <x-heading level="h3">{{ $item['name'] }}</x-heading>
                                        <p>{{ $item['price'] }} Ft </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-x-3">
                                    <x-button color="white" class="ml-auto">Testreszabás</x-button>
                                    <x-tooltip text="Törlés">
                                        <x-button.chip icon="trash" class="remove-cart-item flex-none h-9 -mt-2 -mr-2" data-id="{{ $item['product_id'] }}"/>
                                    </x-tooltip>
                                </div>
                            </div>
                            @php
                                $productId = $item['product_id'];
                                $custom = $customizations[$productId] ?? null;
                            @endphp
                            <form action="" method="POST" id="productCustomizeForm" class="flex flex-col gap-y-4 p-6" enctype="multipart/form-data" novalidate>
                                @csrf
                                <input type="hidden" name="cart_item_id" value="{{ $cartItemId }}" />
                                @if($custom?->front_image)
                                    <div class="form-group">
                                        <label for="customizeFrontImage" class="form-label block text-sm text-gray-500 leading-6">Előlap képe</label>
                                        <input type="file" name="file" id="customizeFrontImage" required/>
                                    </div>
                                @endif
                                @if($custom?->front_text)
                                    <div class="form-group">
                                        <x-form.input label="Előlap szöveg" for="customizeFrontText"/>
                                    </div>
                                @endif
                                @if($custom?->other_notes)
                                    <div class="form-group">
                                        <x-form.textarea label="Egyéb instrukció" for="customizeOtherNotes" rows="4"/>
                                    </div>
                                @endif
            
                                <x-form.checkbox 
                                    for="engrave_second_page" 
                                    class="toggle"
                                    data-target="#customizeBackPage">
                                    A hátoldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                                </x-form.checkbox>
                                <div class="hidden" id="customizeBackPage">
                                    <div class="form-group mb-4">
                                        {{-- <x-form.upload 
                                            for="front_image" 
                                            id="customizeBackImage" 
                                            label="Hátlap képe"
                                            :config="['allowMultiple' => false, 'maxFiles' => 1]"
                                        /> --}}
                                    </div>
                                    @if($custom?->back_text)
                                        <div class="form-group">
                                            <x-form.input label="Hátlap szöveg" for="customizeBackText"/>
                                        </div>
                                    @endif
                                </div>
                                
                                <x-form.checkbox 
                                    for="engrave_third_page" 
                                    class="toggle"
                                    data-target="#customizeInnerPage">
                                    A belső oldalra is kérek gravírozást <span class="text-gray-400">(+2900 Ft)</span>
                                </x-form.checkbox>
                                <div class="hidden" id="customizeInnerPage">
                                    @if($custom?->inner_text)
                                        <div class="form-group">
                                            <x-form.input label="Belső szöveg" for="customizeInnerText"/>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endfor
                @empty
                    <div class="flex flex-col items-center gap-y-6">
                        <img class="px-8" src="{{ asset('/img/empty_cart.png') }}" alt="Üres kosár">
                        <p>Jelenleg nincs termék a kosaradban.</p>
                        <x-button href="{{ route('webshop.home') }}">Vásárlás Folytatása</x-button>
                    </div>
                @endforelse   
                <x-button>Mentés és tovább a megrendeléshez</x-button>
            </div>
        </div>
    </main>

@endsection

@push('styles')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script>
        const inputElement = document.querySelector('#customizeFrontImage');
        const pond = FilePond.create(inputElement, {
            allowProcess: false,
            storeAsFile: true // 👈 important! keeps real file for form submission
        });
    </script>
@endpush