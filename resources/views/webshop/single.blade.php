@extends('layouts.shop')

@section('title', $product->name)

@section('content')

    <x-header.page :title="$product->name"/>

    <main>
        <div class="container">
            <div class="grid grid-cols-2">

                <!-- Product Gallery-->
                <div class="flex">
                    <div class="flex flex-col gap-2">
                        @foreach($images as $image)
                            <img src="/storage/{{ $image->image_path }}" alt="{{ $product->name }} termék kép">
                        @endforeach
                    </div>
                </div>

                <!-- Product Content -->
                <div>

                </div>
                
            </div>
        </div>
    </main>

@endsection
