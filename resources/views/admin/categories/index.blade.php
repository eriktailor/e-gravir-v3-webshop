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
    <div class="flex flex-col gap-3">

        @forelse($categories as $category)
            <div class="p-6 bg-white shadow-md rounded-lg flex items-center justify-between gap-3">
                <div class="flex items-center space-x-4">
                    <button class="p-2">
                        <x-icon name="grip-horizontal" class="text-gray-400"/>
                    </button>
                    <img 
                        src="/storage/{{ $category->image ? $category->image : asset('/img/noimage.webp')}}" 
                        alt="{{ $category->name }}"
                        class="w-18 h-18 rounded-full object-cover object-center">
                    <div>
                        <h3 class="text-lg mb-1">{{ $category->name }}</h3>
                        <p class="text-gray-400 mb-1">/{{ $category->slug }}</p>
                    </div>
                </div>            
                <x-dropdown>
                    <x-slot name="trigger">
                        <x-icon name="dots-vertical" class="text-gray-400" />
                    </x-slot>
                    <a href="{{ route('categories.edit', $category->id) }}">Szerkesztés</a>
                    <a href="#">Törlés</a>
                </x-dropdown>
            </div>
        @empty
            <p>Nincs kategória</p>
        @endforelse

    </div>
</div>

@endsection