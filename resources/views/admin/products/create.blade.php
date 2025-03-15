@extends('layouts.admin')

@section('title', 'Új termék')

@section('content')

<div class="container">
    <form action="" class="grid grid-cols-3 gap-6">
         
        <div class="p-8 bg-white shadow-md rounded-lg">
            <h3 class="text-lg mb-8">Adatok</h3>
            <div class="flex flex-col gap-4">
                <div class="form-group">
                    <x-form.input for="name" label="Név" type="text"/>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="form-group">
                        <x-form.input for="price" label="Normál ár" type="number"/>
                    </div>
                    <div class="form-group">
                        <x-form.input for="sale_price" label="Akciós ár" type="number"/>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="form-group">
                        <x-form.input for="stock" label="Készlet (db)" type="number" min="0"/>
                    </div>
                    <div class="form-group">
                        <x-form.input for="menu_order" label="Sorrend" type="number"/>
                    </div>
                </div>
                <div class="form-group">
                    <x-form.select for="category" label="Kategória" placeholder="Válassz" type="text">
                        <option value="1">Első</option>
                        <option value="2">Második</option>
                        <option value="3">Harmadik</option>
                    </x-form.select>
                </div>
                <div class="form-group">
                    <x-form.checkbox for="is_featured" label="Kiemelt termék"/>                   
                </div>
            </div>
        </div>

        <div class="p-8 bg-white shadow-md rounded-lg">
            <h3 class="text-lg mb-8">Leírások</h3>
            <div class="flex flex-col gap-4">
                <div class="form-group">
                    <x-form.textarea for="excerpt" label="Rövid leírás" rows="3"></x-form.textarea>
                </div>
                <div class="form-group">
                    <x-form.textarea for="description" label="Hosszú leírás" rows="11"></x-form.textarea>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white shadow-md rounded-lg">
            <h3 class="text-lg mb-8">Képek</h3>
            <div class="form-group">
                <input type="file" id="filepond" name="file">
            </div>
        </div>


    </form>
</div>

@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

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
