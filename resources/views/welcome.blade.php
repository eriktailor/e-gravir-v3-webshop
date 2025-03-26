@extends('layouts.shop')

@section('title', 'Teszt')

@section('content')

<form action="{{ route('avatar') }}" method="post">
    @csrf
    <!--  For single file upload  -->
    <input type="file" name="avatar" required/>
    <p class="help-block">{{ $errors->first('avatar') }}</p>

    <!--  For multiple file uploads  -->
    <input type="file" name="gallery[]" multiple required/>
    <p class="help-block">{{ $errors->first('gallery.*') }}</p>

    <button type="submit">Submit</button>
</form>

@endsection

@push('styles')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush
@push('scripts')
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
<script>
    // Set default FilePond options
    FilePond.setOptions({
        server: {
            url: "{{ config('filepond.server.url') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ @csrf_token() }}",
            }
        }
    });

    // Create the FilePond instance
    FilePond.create(document.querySelector('input[name="avatar"]'));
    FilePond.create(document.querySelector('input[name="gallery[]"]'), {chunkUploads: true});
</script>
@endpush
