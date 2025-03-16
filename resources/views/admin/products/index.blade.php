@extends('layouts.admin')

@section('title', 'Termékek')

@section('button')
    <x-button href="{{ route('categories.create') }}">Új kategória</x-button>
@endsection

@section('content')

<x-header.page :title="'Termékek'">
    <x-slot name="button">
        <x-button href="{{ route('products.create') }}">Új Termék</x-button>
    </x-slot>
</x-header.page>

<div class="container">
    <div class="products-list flex flex-col gap-3">
        
        
        

    </div>
</div>

@endsection
