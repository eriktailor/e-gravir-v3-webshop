@extends('layouts.admin')

@section('title', 'Új termék')

@section('content')

<x-header.page :title="'Új termék'">
    <x-slot name="button">
        <x-button href="{{ route('products.create') }}">Termék Mentése</x-button>
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

    <form action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif
        
        <div class="grid grid-cols-2 gap-6">

            <div class="p-8 bg-white shadow-md rounded-lg">
                <h3 class="text-lg mb-8">Adatok</h3>
                <div class="flex flex-col gap-4">
                    <div class="form-group">
                        <x-form.input for="name" label="Név" type="text"/>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <x-form.input for="price" label="Normál ár" type="number"/>
                        </div>
                        <div class="form-group">
                            <x-form.input for="sale_price" label="Akciós ár" type="number"/>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <x-form.input for="in_stock" label="Készlet (db)" type="number" min="0"/>
                        </div>
                        <div class="form-group">
                            <x-form.input for="menu_order" label="Sorrend" type="number"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <x-form.select for="category_id" label="Kategória" type="text" required>
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}" 
                                    {{ old('category_id', $selectedValue ?? '') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                    <div class="form-group">
                        <x-form.input for="tags" label="Címkék" id="tagsInput" :value="isset($product) ? implode(',', $product->tags) : ''" autocomplete="off"/>                
                    </div>
                    <div class="flex gap-x-8 mt-3">
                        <div class="form-group">
                            <x-form.checkbox for="is_featured" label="Kiemelt termék"/>                   
                        </div>
                        <div class="form-group">
                            <x-form.checkbox for="status" label="Rejtett termék"/>                   
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white shadow-md rounded-lg">
                <h3 class="text-lg mb-8">Leírások</h3>
                <div class="flex flex-col gap-4">
                    <div class="form-group">
                        <x-form.textarea for="excerpt" label="Rövid leírás" rows="4"></x-form.textarea>
                    </div>
                    <div class="form-group">
                        <x-form.textarea for="description" label="Hosszú leírás" rows="11"></x-form.textarea>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white shadow-md rounded-lg col-span-2">
                <h3 class="text-lg mb-8">Képek</h3>
                <div class="form-group">
                    <input type="file" id="productImageUpload" class="filepond-product-images" name="images[]" multiple>
                    @if(isset($product) && $product->image)
                        <input type="hidden" id="existingImage" value="{{ asset('storage/' . $product->image) }}">
                    @endif
                </div>
            </div>
        </div>

        <x-button type="submit" class="mt-8 mx-auto inline-block">
            {{ isset($product) ? 'Update' : 'Create' }}
        </x-button>
    </form>
</div>

@endsection

@push('scripts')
    @vite(['resources/js/filepond.js', 'resources/js/tomselect.js'])
@endpush
