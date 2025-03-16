@extends('layouts.admin')

@section('title', 'Új kategória')

@section('content')

<x-header.page :title="'Új kategória'"/>

<div class="container">
    
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="p-8 bg-white shadow-md rounded-lg mx-auto max-w-xl">
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
                    <input type="file" id="image" name="image">
                    @if(isset($category) && $category->image)
                        <input type="hidden" id="existingImage" value="{{ asset('storage/' . $category->image) }}">
                    @endif
                </div>
                <x-button type="submit" class="">
                    {{ isset($category) ? 'Frissítés' : 'Létrehozás' }}
                </x-button>
            </div>
        </div>

    </form>

</div>

@endsection

@push('scripts')
    @vite('resources/js/filepond.js')
@endpush