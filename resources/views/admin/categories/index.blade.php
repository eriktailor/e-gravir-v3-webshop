@extends('layouts.admin')

@section('title', 'Kategóriák')

@section('content')

<div class="container">

    @forelse($categories as $category)
        <div class="p-6 bg-white shadow-md rounded-lg flex items-center justify-between gap-3">
            <div class="flex items-center space-x-4">
                <button class="p-2">
                    <x-icon name="grip-horizontal" class="text-gray-400"/>
                </button>
                <img 
                    src="{{ $category->image ? $category->image : asset('/img/noimage.webp')}}" 
                    alt="{{ $category->name }}"
                    class="w-18 h-18 rounded-full object-cover object-center">
                <div>
                    <h3 class="text-lg mb-1">{{ $category->name }}</h3>
                    <p class="text-gray-400 mb-1">/{{ $category->slug }}</p>
                </div>
            </div>
            <p class="text-gray-400 mb-1">{{ $category->description }}</p>
            <x-icon name="dots-vertical" class="text-gray-400"/>
        </div>
    @empty
        <p>Nincs kategória</p>
    @endforelse

    
</div>

@endsection