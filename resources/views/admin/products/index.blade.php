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
                <div class="flex items-center space-x-4">

                    <img 
                        src="{{ $product->first_image_url }}" 
                        alt="{{ $product->name }} termékkép"
                        class="w-18 h-18 rounded-full object-cover object-center">

                    <div>
                        <h3 class="mb-1">{{ $product->name }}</h3>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-4">
                    <span class="px-2 py-1 bg-gray-200 text-sm rounded-md whitespace-nowrap">valami</span>     
                    <x-button.chip icon="chevron-right" href="{{ route('products.edit', $product->id) }}"/>
                </div>
            </div>
        @empty
            <p>Nincs termék.</p>
        @endforelse

    </div>
</div>

@endsection
