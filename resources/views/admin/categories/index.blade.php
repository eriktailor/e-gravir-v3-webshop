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
    <div class="categories-list flex flex-col">
        @include('admin.categories.list')
    </div>
</div>

@endsection

@push('scripts')
    @vite('resources/js/sortable.js')
@endpush