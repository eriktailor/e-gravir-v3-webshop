@extends('layouts.admin')

@section('title', 'Új kategória')

@section('content')

<x-header.page :title="'Új kategória'"/>

<div class="container">
   

    <div class="p-8 bg-white shadow-md rounded-lg mx-auto max-w-xl">
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
            <div class="form-group">
                <input type="file" id="filepond" name="file">
            </div>
            <x-button type="submit" class="">
                {{ isset($product) ? 'Update' : 'Create' }}
            </x-button>
        </div>
    </div>

</div>

@endsection

@push('styles')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script>
        // Register FilePond plugins (optional)
        FilePond.registerPlugin(FilePondPluginImagePreview);
    
        // Select the input element
        const inputElement = document.querySelector("#filepond");
    
        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            className: 'imageupload',
            allowPaste: false,
            maxFiles: 9,
            itemInsertLocation: 'after',
            allowReorder: true,
            credits: false,
            dropValidation: true,
            labelIdle: 'Húzd ide a képeket, vagy <span class="filepond--label-action"> tallózd </span>',
            imagePreviewHeight: 160,
            //imageCropAspectRatio: '1:1',
            server: {
                process: '{{ route("file.upload") }}', // Laravel route
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF Token for security
                }
            }
        });
    </script>
@endpush