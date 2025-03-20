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
                            <x-form.select for="category_id" label="Kategória" placeholder=" " required>
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
                            <x-form.input for="tags" label="Címkék" id="tagsInput" :value="old('tags', isset($product) ? implode(',', $product->tags) : '')" autocomplete="off"/>                
                        </div>
                        <div class="grid grid-cols-3">
                            <div class="form-group">
                                <x-form.checkbox for="is_featured" label="Kiemelt termék" :checked="old('is_featured', $product->is_featured ?? false)"/>                   
                            </div>
                            <div class="form-group">
                                <x-form.checkbox for="status" label="Rejtett termék" :checked="old('status', $product->status ?? false)"/>                   
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
                                <x-form.input for="extra_price" label="Extra oldal ár" type="number" :value="old('extra_price', $product->extra_price ?? 0)"/>
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
                            <x-form.textarea for="description" label="Hosszú leírás" :value="$product->description ?? ''" />
                        </div>
                    </div>
                </x-card>
                
                

                <!-- Testreszabás -->
                <x-card title="Testreszabás">
                    <div class="grid grid-cols-3 gap-2">
                        <x-form.checkbox for="front_image" label="1. oldal kép" :checked="old('front_image', $productCustomization->front_image ?? false)"/>
                        <x-form.checkbox for="front_text" label="1. oldal szöveg" :checked="old('front_text', $productCustomization->front_text ?? false)"/>
                        <x-form.checkbox for="back_image" label="2. oldal kép" :checked="old('back_image', $productCustomization->back_image ?? false)"/>
                        <x-form.checkbox for="back_text" label="2. oldal szöveg" :checked="old('back_text', $productCustomization->back_text ?? false)"/>
                        <x-form.checkbox for="inner_image" label="3. oldal kép" :checked="old('inner_image', $productCustomization->inner_image ?? false)"/>
                        <x-form.checkbox for="inner_text" label="3. oldal szöveg" :checked="old('inner_text', $productCustomization->inner_text ?? false)"/>
                        <x-form.checkbox for="other_notes" label="Megjegyzés" :checked="old('other_notes', $productCustomization->other_notes ?? false)"/>
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
        'resources/js/tomselect.js',
        'resources/js/easyeditor.js',
    ])
@endpush
