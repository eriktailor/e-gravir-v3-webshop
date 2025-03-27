@extends('layouts.shop')

@section('title', 'Teszt')

@section('content')

<form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" id="filepond">
    <button type="submit">Submit</button>
</form>

@endsection

@push('styles')
<link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script>
const inputElement = document.querySelector('#filepond');
const pond = FilePond.create(inputElement, {
    allowProcess: false,
    storeAsFile: true // 👈 important! keeps real file for form submission
});
</script>
@endpush
