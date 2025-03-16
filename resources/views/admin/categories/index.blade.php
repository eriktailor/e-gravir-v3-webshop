@extends('layouts.admin')

@section('title', 'Kategóriák')

@section('button')
    <x-button href="{{ route('categories.create') }}">Új kategória</x-button>
@endsection

@section('content')

<div class="container">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div>
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
                    <x-dropdown>
                        <x-slot name="trigger">
                            <x-icon name="dots-vertical" class="text-gray-400" />
                        </x-slot>
                        <a href="#">Megtekintés</a>
                        <a href="#">Szerkesztés</a>
                        <a href="#">Törlés</a>
                    </x-dropdown>
                </div>
            @empty
                <p>Nincs kategória</p>
            @endforelse
        </div>

        <div class="p-8 bg-white shadow-md rounded-lg">
            <h3 class="text-lg mb-8">Új kategória</h3>
            <div class="flex flex-col gap-4">
                <div class="form-group">
                    <x-form.input for="name" label="Név" type="text"/>
                </div>
                <div class="form-group">
                    <x-form.input for="slug" label="Egyedi slug" type="text"/>
                </div>
                <div class="form-group">
                    <x-form.textarea for="excerpt" label="Leírás" rows="4"></x-form.textarea>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection