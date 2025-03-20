@extends('layouts.admin')

@section('title', 'Termékek')

@section('button')
    <x-button href="{{ route('categories.create') }}">Új kategória</x-button>
@endsection

@section('content')

<x-header.page :title="'Termékek'">
    <x-slot name="button">
        <x-button href="{{ route('products.create') }}">Új Termék</x-button>
    </x-slot>
</x-header.page>

<div class="container">
    <div class="products-list flex flex-col gap-3">
        
        @forelse($products as $product)
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center justify-between gap-3">
                <div class="grid grid-cols-6 gap-4 w-full items-center">
                    
                    <!-- Product Image & Name -->
                    <div class="flex justify-start items-center gap-x-4 col-span-2">
                        <span class="px-2 py-1 bg-gray-200 text-sm rounded-md whitespace-nowrap mr-1">
                            {{ $product->id }}
                        </span>
                        <img 
                            src="{{ $product->first_image_url }}" 
                            alt="{{ $product->name }} termékkép"
                            class="w-12 h-12 rounded-full object-cover object-center">
                        <x-heading level="h4">
                            {{ $product->name }}
                        </x-heading>
                    </div>

                    <!-- Category -->
                    <div class="flex justify-start">
                        <span class="px-2 py-1 bg-gray-200 text-sm rounded-md whitespace-nowrap">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="flex justify-start gap-x-1">
                        @if($product->sale_price)
                            <span class="line-through">{{ $product->price }} Ft</span> 
                            <span class="text-red-600">{{ $product->sale_price }} Ft</span>
                        @else
                            <span class="text-red-600">{{ $product->price }} Ft</span> 
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="flex justify-start">
                        @if($product->in_stock > 3)
                            <x-badge color="success">{{ $product->in_stock }} db</x-badge>
                        @elseif($product->in_stock > 0 && $product->in_stock <= 3)
                            <x-badge color="warning">{{ $product->in_stock }} db</x-badge>
                        @else
                            <x-badge color="danger">Elfogyott</x-badge>
                        @endif
                    </div>

                    <!-- Featured & Action-->
                    <div class="flex justify-end items-center gap-6">
                        <div class="w-16">
                            @if($product->featured == 1) 
                                <x-tooltip text="Kiemelt">
                                    <x-icon name="star-filled" class="text-amber-400"/>
                                </x-tooltip>
                            @else
                                <x-icon name="star" class="text-amber-400"/>
                            @endif
                        </div>
                        <x-button.chip icon="chevron-right" href="{{ route('products.edit', $product->id) }}"/>
                    </div>
            
                </div>
            </div>
        @empty
            <p>Nincs termék.</p>
        @endforelse

    </div>
</div>

@endsection
