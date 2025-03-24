@extends('layouts.admin')

@section('title', 'Rendelés #' . $order->id)

@section('content')

@php
    $headerTitle = '<span class="text-red-600">#' . $order->id . '</span> Rendelés';
@endphp

<x-header.page :title="$headerTitle">
    <x-slot name="button">
        <x-button href="{{ route('orders.index') }}">Vissza</x-button>
    </x-slot>
</x-header.page>

<div class="container">
    <div class="grid grid-cols-1 lg:grid-cols-2">

        <div>

            <!-- Rendelés -->
            <x-card title="Rendelés" padding="p-12">
                <div class="grid grid-cols-4 items-center gap-4">
                    <div class="col-span-1">
                        <strong class="font-semibold">Státusz:</strong> 
                    </div>
                    <div class="col-span-3">
                        @php
                            $order_status = config('checkout.order_statuses')[$order->status];
                        @endphp
                        <x-badge color="{{ $order_status['color'] }}" class="inline-block">
                            {{ $order_status['label'] }}
                        </x-badge>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-semibold">Dátum:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->created_at->toDateString() }}</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-semibold">Szállítás:</strong> 
                    </div>
                    <div class="col-span-3">
                        @php
                            $delivery_label = config('checkout.delivery_methods')[$order->delivery_method]['label'] ?? 'Szállítás';
                        @endphp
                        <span>{{ $delivery_label }}</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-semibold">Fizetés:</strong> 
                    </div>
                    <div class="col-span-3">
                        @php
                            $payment_label = config('checkout.payment_methods')[$order->payment_method]['label'] ?? 'Fizetés';
                        @endphp
                        <span>{{ $payment_label }}</span>
                    </div>
                </div>
            </x-card>

            <!-- Termékek -->
            <x-card title="Termékek" padding="p-12">
                <div class="flex flex-col gap-4">
                    @foreach($order->items as $item)
                        <div class="border border-gray-300 rounded-lg flex flex-col justify-between">
                            <div class="flex gap-x-3 justify-between p-4">
                                <div class="flex gap-x-3">
                                    <img 
                                        src="{{ $item->product->firstImageUrl() }}" 
                                        alt="{{ $item->product_name }} termékkép"
                                        class="w-12 h-12 rounded-lg object-cover object-center">
                                    <x-heading level="h4">
                                        {{ $item->product_name }}
                                    </x-heading>
                                </div>
                                <span class="text-gray-400">
                                    {{ $item->product_price }} Ft
                                </span>
                            </div>
                            @php
                                $custom = $order->customizations->firstWhere('product_id', $item->product_id);
                            @endphp
                            @if($custom)

                                @if($custom->front_image || $custom->front_text)
                                    <div class="p-4 border-t border-gray-300">
                                        <x-heading level="h5">Előlap</x-heading>
                                        <div class="flex items-center gap-x-3">
                                            @if($custom->front_image)
                                                <div>
                                                    <img src="{{ asset('storage/' . $custom->front_image) }}" alt="Front Image" class="w-12 h-12 rounded-lg">
                                                </div>
                                            @endif

                                            @if($custom->front_text)
                                                <div>
                                                    {{ $custom->front_text }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
{{-- 
                                <div class="text-sm text-gray-500 mt-2">
                                    <ul class="list-disc ml-4">

                                        

                                        @if($custom->back_image)
                                            <li>
                                                <strong>Hátlap kép:</strong><br>
                                                <img src="{{ asset('storage/' . $custom->back_image) }}" alt="Back Image" class="w-16 h-16 rounded-lg mt-2">
                                            </li>
                                        @endif

                                        @if($custom->inner_text)
                                            <li><strong>Belső szöveg:</strong> {{ $custom->inner_text }}</li>
                                        @endif

                                        @if($custom->other_notes)
                                            <li><strong>Megjegyzés:</strong> {{ $custom->other_notes }}</li>
                                        @endif

                                    </ul>
                                </div> --}}
                            @endif


                        </div>
                    @endforeach
                </div>
            </x-card>

        </div>
        <div>

        </div>

    </div>
</div>

@endsection
