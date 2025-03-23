@extends('layouts.shop')

@section('title', $product->name)

@section('content')

    <x-header.page :title="$product->name"/>

    <main>
        <div class="container">
            <div class="grid grid-cols-2">

                <!-- Product Gallery-->
                <div class="flex gap-x-2">
                    <div class="flex flex-col gap-2">
                        @foreach($images as $image)
                            <img src="/storage/{{ $image->image_path }}" 
                                alt="{{ $product->name }} termék kép"
                                class="w-[50px] h-[50px] object-cover object-center flex-none rounded">
                        @endforeach
                    </div>
                    <div class="flex grow">
                        @if(isset($images[0]))
                            <img src="/storage/{{ $images[0]->image_path }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover object-center rounded-lg">
                        @endif
                    </div>
                </div>

                <!-- Product Content -->
                <div>

                </div>
                
            </div>
        </div>
    </main>

@endsection
