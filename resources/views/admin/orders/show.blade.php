@extends('layouts.admin')

@section('title', 'Rendelés #' . $order->id)

@section('content')

@php
    $headerTitle = '<span class="text-red-600">#' . $order->id . '</span> Rendelés';
@endphp

<x-header.page :title="$headerTitle">
    <x-slot name="button">
        <x-button href="{{ route('orders.edit', $order) }}">Szerkesztés</x-button>
    </x-slot>
</x-header.page>

<div class="container">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div>

            <!-- Rendelés -->
            <x-card title="Rendelés" padding="p-12" class="font-normal">
                <div class="grid grid-cols-4 items-center gap-4">
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Státusz:</strong> 
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
                        <strong class="font-medium text-stone-950">Dátum:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->created_at->toDateString() }}</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Szállítás:</strong> 
                    </div>
                    <div class="col-span-3">
                        @php
                            $delivery_label = config('checkout.delivery_methods')[$order->delivery_method]['label'] ?? 'Szállítás';
                        @endphp
                        <span>{{ $delivery_label }}</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Fizetés:</strong> 
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
            <x-card title="Termékek" padding="p-12" class="relative font-normal">
                <x-button id="downloadOrderImages" 
                        color="white" 
                        size="small" 
                        class="absolute top-10 right-12" 
                        href="{{ route('orders.downloadImages', $order->id) }}" 
                        target="_blank">
                    Képek Letöltése
                </x-button>
                <div class="flex flex-col gap-4">
                    @foreach($order->items as $item)
                        <div class="border border-gray-300 rounded-lg flex flex-col justify-between">
                            <div class="flex gap-x-3 justify-between p-4">
                                <div class="flex gap-x-3">
                                    {{-- <img 
                                        src="{{ $item->product->firstImageUrl() }}" 
                                        alt="{{ $item->product_name }} termékkép"
                                        class="w-12 h-12 rounded-lg object-cover object-center"> --}}
                                    <x-heading level="h4">
                                        {{ $item->product_name }}
                                    </x-heading>
                                </div>
                                <span class="text-gray-400 font-normal">
                                    {{ $item->product_price }} Ft
                                </span>
                            </div>
                            @php
                                $custom = $order->customizations->firstWhere('product_id', $item->product_id);
                            @endphp
                            @if($custom)

                                @if($custom->front_image || $custom->front_text)
                                    <div class="p-4 border-t border-gray-300 flex justify-between items-center gap-x-6">
                                        <div class="flex items-center gap-x-3">
                                            @if($custom->front_image)
                                                <div>
                                                    <img src="{{ asset('storage/' . $custom->front_image) }}" alt="Front Image" class="w-12 h-12 rounded-lg">
                                                </div>
                                            @endif

                                            @if($custom->front_text)
                                                <div class="text-sm">
                                                    {{ $custom->front_text }}
                                                </div>
                                            @endif
                                        </div>
                                        <x-badge>Előlap</x-badge>
                                    </div>
                                @endif

                                @if($custom->back_image || $custom->back_text)
                                    <div class="p-4 border-t border-gray-300 flex justify-between items-center gap-x-6">
                                        <div class="flex items-center gap-x-3">
                                            @if($custom->back_image)
                                                <div>
                                                    <img src="{{ asset('storage/' . $custom->back_image) }}" alt="Back Image" class="w-12 h-12 rounded-lg">
                                                </div>
                                            @endif

                                            @if($custom->back_text)
                                                <div class="text-sm">
                                                    {{ $custom->back_text }}
                                                </div>
                                            @endif
                                        </div>
                                        <x-badge>Hátlap</x-badge>
                                    </div>
                                @endif

                                @if($custom->inner_text)
                                    <div class="p-4 border-t border-gray-300 flex justify-between items-center gap-x-6">
                                        <div class="flex items-center gap-x-3">
                                            <div class="text-sm">
                                                {{ $custom->inner_text }}
                                            </div>
                                        </div>
                                        <x-badge>Belső</x-badge>
                                    </div>
                                @endif

                                @if($custom->other_notes)
                                    <div class="p-4 border-t border-gray-300 flex justify-between items-center gap-x-6">
                                        <div class="flex items-center gap-x-3">
                                            <div class="text-sm">
                                                {{ $custom->other_notes }}
                                            </div>
                                        </div>
                                        <x-badge>Megjegyzés</x-badge>
                                    </div>
                                @endif

                            @endif

                        </div>
                    @endforeach
                </div>
            </x-card>

            <!-- Számlázás -->
            <x-card title="Számlázás" padding="p-12" class="font-normal">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Termékek:</strong> 
                    </div>
                    <div class="col-span-3">
                        {{ $order->products_total }} Ft
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Extra felár:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->extra_price }} Ft</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Szállítási díj:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->delivery_price }} Ft</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Végösszeg:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span class="text-red-600 font-semibold">{{ $order->order_total }} Ft</span>
                    </div>
                </div>
                @if($order->invoice_number)
                    <div class="bg-green-100 text-green-600 py-3 px-4 rounded-lg mt-6">
                        A <strong>{{ $order->invoice_number }}</strong> sorszámú számla elkészült.
                    </div>
                @endif
            </x-card>

            <!-- Ügyfél -->
            <x-card title="Ügyfél" padding="p-12" class="font-normal">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Név:</strong> 
                    </div>
                    <div class="col-span-3">
                        {{ $order->customer_name }}
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Email:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->customer_email }}</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Telefon:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->customer_phone }}</span>
                    </div>
                    <div class="col-span-1">
                        <strong class="font-medium text-stone-950">Lakcím:</strong> 
                    </div>
                    <div class="col-span-3">
                        <span>{{ $order->customer_zip . ' ' . $order->customer_city . ', ' . $order->customer_address }}</span>
                    </div>
                    @if($order->delivery_notes)
                        <div class="col-span-1">
                            <strong class="font-medium text-stone-950">Megjegyzés:</strong> 
                        </div>
                        <div class="col-span-3">
                            <span>{{ $order->delivery_notes }}</span>
                        </div>
                    @endif
                </div>
            </x-card>

        </div>
        <div>

            <!-- Projekt -->
            <x-card title="Projekt" padding="p-12 sticky top-[96px]">
               <form action="" class="flex flex-col gap-4">
                    <x-form.select for="status">
                        @foreach(config('checkout.order_statuses') as $key => $status)
                            <option value="{{ $key }}" @selected($order->status === $key)>
                                {{ $status['label'] }}
                            </option>
                        @endforeach
                    </x-form.select>
                    <x-form.textarea for="my_notes" placeholder="Személyes megjegyzés" rows="4"/>
                    <x-form.switch for="send_invoice" label="Számla kiküldése mentéskor"/>
                    <x-button type="submit" class="w-full">
                        Projekt Mentése
                    </x-button>
               </form>
            </x-card>

        </div>

    </div>
</div>

@endsection
