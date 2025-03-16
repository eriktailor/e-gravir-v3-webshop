@extends('layouts.admin')

@section('title', isset($product) ? 'Termék szerkesztése' : 'Új termék')

@section('content')

<x-header.page :title="isset($product) ? 'Termék szerkesztése' : 'Új termék'">
    <x-slot name="button">
        <x-button class="button-submit" data-target="#productForm">Mentés</x-button>
    </x-slot>
</x-header.page>

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="container">

    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" id="productForm" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        
        <div class="grid grid-cols-2 gap-6">

            <div class="p-8 bg-white shadow-md rounded-lg">
                <h3 class="text-lg mb-8">Adatok</h3>
                <div class="flex flex-col gap-4">
                    <div class="form-group">
                        <x-form.input for="name" label="Név" type="text" :value="old('name', $product->name ?? '')"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <x-form.input for="price" label="Normál ár" type="number" :value="old('price', $product->price ?? '')"/>
                        </div>
                        <div class="form-group">
                            <x-form.input for="sale_price" label="Akciós ár" type="number" :value="old('sale_price', $product->sale_price ?? '')"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <x-form.input for="in_stock" label="Készlet (db)" type="number" min="0" :value="old('in_stock', $product->in_stock ?? '')"/>
                        </div>
                        <div class="form-group">
                            <x-form.input for="menu_order" label="Sorrend" type="number" :value="old('menu_order', $product->menu_order ?? '')"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <x-form.select for="category_id" label="Kategória" type="text" required>
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
                    <div class="flex gap-x-8 mt-3">
                        <div class="form-group">
                            <x-form.checkbox for="is_featured" label="Kiemelt termék" :checked="old('is_featured', $product->is_featured ?? false)"/>                   
                        </div>
                        <div class="form-group">
                            <x-form.checkbox for="status" label="Rejtett termék" :checked="old('status', $product->status ?? false)"/>                   
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white shadow-md rounded-lg">
                <h3 class="text-lg mb-8">Leírások</h3>
                <div class="flex flex-col gap-4">
                    <div class="form-group">
                        <x-form.textarea for="short_description" label="Rövid leírás" rows="4">{{ old('short_description', $product->short_description ?? '') }}</x-form.textarea>
                    </div>
                    <div class="form-group">
                        <x-form.textarea for="description" label="Hosszú leírás" rows="11">{{ old('description', $product->description ?? '') }}</x-form.textarea>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white shadow-md rounded-lg col-span-2">
                <h3 class="text-lg mb-8">Képek</h3>
                <div class="form-group">
                    <input type="file" id="productImageUpload" class="filepond-product-images filepond-cover" name="images[]" multiple>
                </div>
            </div>
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
    @vite(['resources/js/filepond.js', 'resources/js/tomselect.js'])
@endpush
