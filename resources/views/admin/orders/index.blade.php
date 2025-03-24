@extends('layouts.admin')

@section('title', 'Rendelések')

@section('content')

<x-header.page :title="'Rendelések'">
    <x-slot name="button">
        <x-button href="#">Export Foxpost Csv</x-button>
    </x-slot>
</x-header.page>

<div class="container">
    <div class="orders-list flex flex-col">
        
        @forelse($orders as $order)
            <x-card class="flex items-center justify-between">
                <div class="grid grid-cols-12 items-center sm:w-2/5 md:w-3/5">
                    <x-form.checkbox for="select_order[' . $order->id .']"/>
                    <div>
                        <x-badge>#{{ $order->id }}</x-badge>
                    </div>
                    <div>
                        <x-heading level="h4" class="lg:mb-2">{{ $order->customer_name }}</x-heading>
                        <p class="text-gray-400 text-sm max-w-[500px] hidden lg:block lg:mr-6">{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <span class="text-lg">{{ $order->order_total }}</span>
                        <span class="text-lg">{{ $order->products->count() }} termék</span>
                    </div>

                    <x-button.chip icon="chevron-right" href="{{ route('orders.edit', $order->id) }}"/>
                </div>
            </x-card>
        @empty
            <p>Nincs Rendelés</p>
        @endforelse

    </div>
</div>

@endsection