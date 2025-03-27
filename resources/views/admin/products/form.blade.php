@extends('layouts.admin')

@section('title', isset($product) ? 'Termék szerkesztése' : 'Új termék')

@section('content')

<x-header.page :title="isset($product) ? 'Termék szerkesztése' : 'Új termék létrehozása'">
    <x-slot name="button">
        <x-button class="button-submit" data-target="#productForm">Mentés</x-button>
    </x-slot>
</x-header.page>

<div class="container">

    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" id="productForm" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        
        <div class="columns-2 gap-6">

                <!-- Adatok -->
                <x-card title="Adatok">
                    <div class="flex flex-col gap-4">
                        <div class="form-group">
                            <x-form.input for="name" label="Név" type="text" :value="old('name', $product->name ?? '')"/>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="form-group">
                                <x-form.input for="in_stock" label="Készlet (db)" type="number" min="0" :value="old('in_stock', $product->in_stock ?? '')"/>
                            </div>
                            <div class="form-group">
                                <x-form.input for="menu_order" label="Sorrend" type="number" :value="old('menu_order', $product->menu_order ?? '')" helptext="Pozíció a listában"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <x-form.select for="category_id" label="Kategória" placeholder="Válassz" required>
                                @foreach($categories as $category)
                                    <option 
                                        value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>
                        <div class="form-group">
                            <x-form.tags for="tags" label="Címkék" :value="isset($product) ? implode(',', $product->tags) : ''" />     
                        </div>
                        <div class="grid grid-cols-3">
                            <div class="form-group">
                                <x-form.checkbox for="featured" :checked="old('is_featured', $product->featured ?? false)">
                                    Kiemelt termék
                                </x-form.checkbox>                   
                            </div>
                            <div class="form-group">
                                <x-form.checkbox for="hidden" :checked="old('hidden', $product->hidden ?? false)">
                                    Rejtett termék
                                </x-form.checkbox>                   
                            </div>
                        </div>
                    </div>
                </x-card>

                <!-- Árazás -->
                <x-card title="Árazás">
                    <div class="flex flex-col gap-4">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="form-group">
                                <x-form.input for="price" label="Normál ár" type="number" :value="old('price', $product->price ?? '')"/>
                            </div>
                            <div class="form-group">
                                <x-form.input for="sale_price" label="Akciós ár" type="number" :value="old('sale_price', $product->sale_price ?? '')"/>
                            </div>
                            <div class="form-group">
                                <x-form.input for="extra_price" label="Extra oldal ár" type="number" :value="old('extra_price', $product->extra_price ?? '')"/>
                            </div>
                        </div>
                    </div>
                </x-card>

                <!-- Variációk -->
                <x-card title="Variációk">
                    <div id="variationsWrapper" class="flex flex-col gap-3">
                        @if(isset($product) && $product->variations->count())
                            @foreach($product->variations as $index => $variation)
                                @include('admin.products.variation', [
                                    'index' => $index,
                                    'variation' => $variation,
                                    'options' => $options
                                ])
                            @endforeach
                        @endif
                    </div>
                    <x-button id="addVariation" color="white" size="small">
                        Új variáció hozzáadása
                    </x-button>
                </x-card>

                 <!-- Testreszabás -->
                 <x-card title="Testreszabás">
                    <div class="grid grid-cols-3 gap-2">
                        <x-form.checkbox for="front_image" :checked="old('front_image', $productCustomization->front_image ?? false) == 1">
                            Előlap kép
                        </x-form.checkbox>
                        <x-form.checkbox for="front_text" :checked="old('front_text', $productCustomization->front_text ?? false) == 1">
                            Előlap szöveg
                        </x-form.checkbox>
                        <x-form.checkbox for="back_image" :checked="old('back_image', $productCustomization->back_image ?? false) == 1">
                            Hátlap kép
                        </x-form.checkbox>
                        <x-form.checkbox for="back_text" :checked="old('back_text', $productCustomization->back_text ?? false) == 1">
                            Hátlap szöveg
                        </x-form.checkbox>
                        <x-form.checkbox for="inner_text" :checked="old('inner_text', $productCustomization->inner_text ?? false) == 1">
                            Belső oldal szöveg
                        </x-form.checkbox>
                        <x-form.checkbox for="other_notes" :checked="old('other_notes', $productCustomization->other_notes ?? false) == 1">
                            Egyéb megjegyzés
                        </x-form.checkbox>
                    </div>
                </x-card>
                
                <!-- Képek -->
                <x-card title="Képek">
                    <div class="form-group">
                        <input type="file" id="productImageUpload" class="filepond-product-images filepond-cover" name="images[]" multiple>
                    </div>
                </x-card>

                <!-- Leírások -->
                <x-card title="Leírások">
                    <div class="flex flex-col gap-4">
                        <div class="form-group">
                            <x-form.textarea for="short_description" label="Rövid leírás" rows="4">{{ old('short_description', $product->short_description ?? '') }}</x-form.textarea>
                        </div>
                        <div class="form-group">
                            <x-form.editor for="description" label="Hosszú leírás"/>
                        </div>
                    </div>
                </x-card>

        </div>

    </form>
</div>

@endsection

@push('scripts')
    @if(isset($product))
        <script>
            window.existingProductImages = @json($existingImages);
        </script>
    @endif
    
    @vite([
        'resources/js/filepond.js', 
    ])
@endpush
