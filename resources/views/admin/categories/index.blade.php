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
    <div class="categories-list flex flex-col">
        
        @forelse($categories as $category)
            <x-card class="flex items-center justify-between" data-id="{{ $category->id }}">
                <div class="flex items-center sm:w-2/5 md:w-3/5">
                    <button class="p-2 grip-handle mr-3 hidden md:block">
                        <x-icon name="grip-horizontal" class="text-gray-400"/>
                    </button>
                    <img 
                        src="{{ get_image_or_placeholder($category->image) }}" 
                        alt="{{ $category->name }}"
                        class="w-12 h-12 lg:w-18 lg:h-18 rounded-lg object-cover object-center mr-4">
                    <div>
                        <x-heading level="h4" class="lg:mb-2">{{ $category->name }}</x-heading>
                        <p class="text-gray-400 text-sm max-w-[500px] hidden lg:block lg:mr-6">{{ $category->description }}</p>
                    </div>
                </div>
                <div class="w-1/5 hidden sm:block text-right">
                    <x-badge color="success" class="mr-6">
                        {{ $category->products->count() }} termék
                    </x-badge>
                </div>
                <div class="flex items-center justify-end w-2/5 lg:w-1/5">
                    <x-badge class="hidden sm:block mr-3">
                        /{{ $category->slug }}
                    </x-badge>     
                    <x-button.chip icon="chevron-right" href="{{ route('categories.edit', $category->id) }}"/>
                </div>
            </x-card>
        @empty
            <p>Nincs kategória</p>
        @endforelse

    </div>
</div>

@endsection

@push('scripts')
    @vite('resources/js/sortable.js')
@endpush