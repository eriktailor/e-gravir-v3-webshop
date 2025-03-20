@extends('layouts.shop')

@section('title', $category->name)

@section('content')

    <x-header.page :title="'Gravírozott ' . $category->name"/>

    <main>
        <div class="container">
            @if($products->count())
                <ul class="archive-products grid grid-cols-4 gap-4">
                    @foreach($products as $product)
                        <li class="product-item bg-white flex flex-col gap-y-3 rounded-xl shadow-sm shadow-amber-700/20 p-6">

                            <!-- Featured Image -->
                            <a class="relative w-full h-48 overflow-hidden rounded-lg group" href="#">
                                @foreach($product->images->take(2) as $key => $image)
                                    <img class="absolute top-0 left-0 w-full h-full object-cover object-center transition-all ease-in-out duration-700 
                                                {{ $key === 0 ? 'opacity-100 group-hover:opacity-0' : 'scale-110 opacity-0 group-hover:opacity-100 group-hover:scale-100' }}" 
                                         src="{{ '/storage/' . $image->image_path }}" 
                                         alt="{{ $product->name }} Termékkép">
                                @endforeach
                            </a>

                            <x-heading level="h3">
                                <a href="#">{{ $product->name }}</a>
                            </x-heading>
                            <div class="flex items-center justify-between">
                                <div class="product-price">
                                    @if($product->sale_price)
                                        <span class="line-through text-gray-400">{{ $product->sale_price}}</span>
                                    @endif
                                    <span>{{ $product->price }} Ft</span>
                                </div>
                                <x-badge color="success">Raktáron</x-badge>
                            </div>
                            <x-button class="w-full">Kosárba</x-button>
                            
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Nem található termék ebben a kategóriában.</p>
            @endif
        </div>
    </main>

@endsection
