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
                        <div class="border border-gray-300 p-4 rounded-lg flex justify-between">
                            <div>
                                <strong>{{ $item->product_name }}</strong><br>
                                Ár: {{ $item->product_price }} Ft<br>
                            </div>
                            @if($item->customizations)
                                <div class="text-sm text-gray-500">
                                    Testreszabás:
                                    <pre>{{ json_encode($item->customizations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                </div>
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
