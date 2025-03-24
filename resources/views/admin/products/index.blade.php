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
    <div class="mb-4">
        <x-form.input for="product_search" placeholder="Keresés név alapján..."/>
    </div>
    <div id="productsList">
        @include('admin.products.list', ['products' => $products])
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $('#product_search').on('input', function() {
            let query = $(this).val();

            $.ajax({
                url: '{{ route("products.index") }}',
                type: 'GET',
                data: { search: query },
                success: function(response) {
                    $('#productsList').html(response);
                }
            });
        });
    </script>
@endpush