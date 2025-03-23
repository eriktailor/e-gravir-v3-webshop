@extends('layouts.admin')

@section('title', isset($category) ? 'Kategória szerkesztése' : 'Új kategória')

@section('content')

<x-header.page :title="isset($category) ? 'Kategória szerkesztése' : 'Új kategória'"/>

<div class="container">
    <div class="p-8 bg-white shadow-md rounded-lg mx-auto max-w-xl">
    
        <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" id="categoryForm" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif

            <div class="flex flex-col gap-4">
                <div class="form-group">
                    <x-form.input for="name" label="Név" type="text" :value="$category->name ?? ''"/>
                </div>
                <div class="form-group">
                    <x-form.input for="slug" label="Egyedi slug" type="text" :value="$category->slug ?? ''"/>
                </div>
                <div class="form-group">
                    <x-form.textarea for="description" label="Leírás" rows="4">{{ old('description', $category->description ?? '') }}</x-form.textarea>
                </div>
                <div class="form-group">
                    <input type="file" id="categoryImageUpload" name="image">
                    @if(isset($category) && $category->image)
                        <input type="hidden" id="existingImage" value="{{ asset('storage/' . $category->image) }}">
                    @endif
                </div>
                <x-button type="submit">
                    {{ isset($category) ? 'Frissítés' : 'Létrehozás' }}
                </x-button>
            </div>
        </form>

        @if(isset($category))
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Biztosan törölni szeretnéd?')">
                @csrf
                @method('DELETE')
                <button type="submit" href="{{ route('categories.destroy', $category->id) }}" class="mx-auto block underline underline-offset-2 hover:no-underline transition cursor-pointer mt-4">
                    Kategória törlése
                </button>
            </form>
        @endif

    </div>
</div>

@endsection

@push('scripts')
    @vite('resources/js/filepond.js')
@endpush