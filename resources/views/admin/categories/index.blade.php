@extends('layouts.admin')

@section('title', 'Kategóriák')

@section('button')
    <x-button href="{{ route('categories.create') }}">Új kategória</x-button>
@endsection

@section('content')

<x-header.page :title="'Kategóriák'">
    <x-slot name="button">
        <x-button href="{{ route('categories.create') }}">Új Kategória</x-button>
    </x-slot>
</x-header.page>

<div class="container">
    <div class="categories-list flex flex-col gap-3">
        
        @forelse($categories as $category)
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center justify-between gap-3" data-id="{{ $category->id }}">
                <div class="flex items-center space-x-4">
                    <button class="p-2 grip-handle">
                        <x-icon name="grip-horizontal" class="text-gray-400"/>
                    </button>
                    <img 
                        src="{{ get_image_or_placeholder($category->image) }}" 
                        alt="{{ $category->name }}"
                        class="w-18 h-18 rounded-full object-cover object-center">
                    <div>
                        <x-heading level="h4" class="mb-1">{{ $category->name }}</x-heading>
                        <p class="text-gray-400 text-sm max-w-[500px]">{{ $category->description }}</p>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-4">
                    <span class="px-2 py-1 bg-gray-200 text-sm rounded-md whitespace-nowrap">{{ $category->slug }}</span>     
                    <x-button.chip icon="chevron-right" href="{{ route('categories.edit', $category->id) }}"/>
                </div>
            </div>
        @empty
            <p>Nincs kategória</p>
        @endforelse

    </div>
</div>

@endsection

@push('scripts')
    @vite('resources/js/sortable.js')
@endpush