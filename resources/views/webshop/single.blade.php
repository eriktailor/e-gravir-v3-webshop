@extends('layouts.shop')

@section('title', $product->name)

@section('content')

    <x-header.page :title="$product->name"/>

    <main>
        <div class="container">
            
        </div>
    </main>

@endsection
