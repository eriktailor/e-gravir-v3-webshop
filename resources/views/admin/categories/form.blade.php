@extends('layouts.admin')

@section('title', isset($category) ? 'Kategória szerkesztése' : 'Új kategória')

@section('content')

<x-header.page :title="isset($category) ? 'Kategória szerkesztése' : 'Új kategória'"/>

<div class="container">
    <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" id="categoryForm" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($category))
            @method('PUT')
        @endif

        <div class="grid grid-cols-2 gap-6">

            <x-card title="Adatok">
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
                </div>
            </x-card>

            <x-card title="Képek">
                <div class="form-group mb-6">
                    <x-form.upload 
                        for="front_image" 
                        id="customizeFrontImage" 
                        multiple 
                        :config="['allowMultiple' => false, 'maxFiles' => 1]"
                    />
                </div>
                <div class="flex items-center justify-between">
                    @if(isset($category))
                        <button 
                            type="button" 
                            class="block underline underline-offset-2 hover:no-underline transition cursor-pointer delete-category-btn"
                            data-id="{{ $category->id }}"
                            data-url="{{ route('categories.destroy', $category->id) }}"
                        >
                            Kategória törlése
                        </button>
                    @endif
                    <x-button type="submit">
                        {{ isset($category) ? 'Frissítés' : 'Létrehozás' }}
                    </x-button>
                </div>
            </x-card>
        
        </div>

    </form>
</div>

@endsection

@push('scripts')
    <script>
        $('.delete-category-btn').on('click', function(e) {
            if(confirm('Biztosan törölni szeretnéd?')) {
                let url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Redirect or show message
                        window.location.href = "{{ route('categories.index') }}";
                    },
                    error: function(err) {
                        alert('Hiba történt!');
                    }
                });
            }
        });
    </script>
@endpush