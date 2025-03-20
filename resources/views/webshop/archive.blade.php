@extends('layouts.shop')

@section('title', $category->name)

@section('content')

    <x-header.page :title="'Gravírozott ' . $category->name"/>

    <main>
        <div class="container">
            @if($products->count())
                <ul class="archive-products grid grid-cols-4 gap-4">
                    @foreach($products as $product)
                        <li class="product-item bg-white rounded-lg p-6">
                            @foreach($product->images->take(2) as $image)
                                <img class="w-full h-48 object-cover object-center" src="{{ '/storage/' . $image->image_path }}" alt="{{ $product->name }} Termékkép">
                            @endforeach
                            <x-heading level="h3">{{ $product->name }}</x-heading>
                            
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Nem található termék ebben a kategóriában.</p>
            @endif
        </div>
    </main>

@endsection
