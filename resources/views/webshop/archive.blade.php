@extends('layouts.shop')

@section('title', $category->name)

@section('content')

    <x-header.page :title="'Gravírozott ' . $category->name"/>

    <main>
        <div class="container">
            @if($products->count())
                <ul class="archive-products grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <li class="product-item bg-white flex flex-col gap-y-3 rounded-xl shadow-sm shadow-amber-700/20 p-8">

                            <!-- Featured Image -->
                            <a class="relative w-full h-64 overflow-hidden rounded-lg group" href="#">
                                @if($product->images->count())
                                    @foreach($product->images->take(2) as $key => $image)
                                        <img class="absolute top-0 left-0 w-full h-full object-cover object-center transition-all ease-in-out duration-700 
                                                    {{ $key === 0 ? 'opacity-100 group-hover:opacity-0' : 'scale-110 opacity-0 group-hover:opacity-100 group-hover:scale-100' }}"  
                                            src="{{ get_image_or_placeholder($image->image_path) }}" 
                                            alt="{{ $product->name }} Termékkép">
                                    @endforeach
                                @else
                                    <img class="absolute top-0 left-0 w-full h-full object-cover object-center opacity-100" 
                                        src="{{ get_image_or_placeholder(null) }}" 
                                        alt="Termékkép">
                                @endif
                                <div class="absolute left-0 top-0 z-10 p-3 flex gap-x-3">
                                    @if($product->sale_price)
                                        <x-badge color="success">Akciós</x-badge>
                                    @endif
                                    @if($product->created_at->gt(now()->subMonth()) )
                                        <x-badge color="success">Újdonság</x-badge>
                                    @endif
                                </div>
                            </a>
                            
                            <!-- Contents -->
                            <x-heading level="h3">
                                <a href="#" class="break-words leading-tight w-full max-w-[16ch] line-clamp-2">{{ $product->name }}</a>
                            </x-heading>
                            <div class="flex items-end justify-between">
                                <div class="product-price">
                                    @if($product->sale_price)
                                        <span class="line-through text-gray-400">{{ $product->sale_price}}</span>
                                    @endif
                                    <span>{{ $product->price }} Ft</span>
                                </div>
                                @if($product->in_stock > 0)
                                    <x-badge color="success">Raktáron</x-badge>
                                @else
                                    <x-badge color="danger">Elfogyott</x-badge>
                                @endif
                            </div>

                            <!-- Button -->
                            <x-button class="add-to-cart-btn w-full" data-id="{{ $product->id }}" :disabled="$product->in_stock === 0">
                                Kosárba teszem
                            </x-button>

                        </li>
                    @endforeach
                </ul>
            @else
                <p>Nem található termék ebben a kategóriában.</p>
            @endif
        </div>
    </main>

@endsection
