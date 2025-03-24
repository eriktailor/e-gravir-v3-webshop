@extends('layouts.shop')

@section('title', 'Pénztár')

@section('content')

    <x-header.page :title="'Megrendelés'"/>

    <main>
        <div class="container">
            <div class="flex gap-6">

                <div class="grow">
                    <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST" novalidate>
                        @csrf
                        
                        @include('admin.orders.fields')

                    </form>
                </div>
                <div class="w-[500px] flex-none">

                    <!-- Termékek -->
                    <x-card title="Összesítés" class="sticky top-[96px]">
                        <div class="cart-items flex flex-col">
                            @forelse(session('cart', []) as $id => $item)
                                @for ($i = 0; $i < $item['quantity']; $i++)
                                    <div class="cart-item flex gap-x-3 pb-4 mb-4 border-b border-gray-300">
                                        <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" 
                                            class="w-18 h-18 object-cover object-center rounded-lg"
                                            alt="{{ $item['name'] }}" 
                                            class="w-full h-full object-cover rounded-lg" />
                                        <div class="w-4/5 flex flex-col justify-between">
                                            <x-heading level="h4" class="mb-2">
                                                {{ $item['name'] }}
                                            </x-heading>
                                            <a href="#sideCustomizer" 
                                                class="offcanvas-toggle text-sm text-red-600 underline underline-offset-2">
                                                Testreszabás
                                            </a>
                                        </div>
                                        <div class="w-1/5 flex flex-col justify-between items-end">
                                            <x-tooltip text="Törlés">
                                                <x-button.chip icon="trash" class="remove-cart-item -mt-2.5 -mr-2" data-id="{{ $id }}"/>
                                            </x-tooltip>
                                            <p class="text-sm text-gray-400 whitespace-nowrap">
                                                {{ $item['price'] }} Ft
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            @empty
                                <p>Nincs termék a kosárban.</p>
                            @endforelse
                            <div class="order-summary flex flex-col gap-y-2 my-3">
                                <div class="flex justify-between">
                                    Termékek
                                    <span>0 Ft</span>
                                </div>
                                <div class="flex justify-between">
                                    Extra felár
                                    <span>0 Ft</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-300 mb-2 pb-4">
                                    Szállítási díj
                                    <span>0 Ft</span>
                                </div>
                                <div class="flex justify-between text-stone-950 mb-1">
                                    <strong>Végösszeg</strong>
                                    <span>0 Ft</span>
                                </div>
                            </div>
                            <x-button class="button-submit" data-target="#checkoutForm">
                                Megrendelés Elküldése
                            </x-button>
                        </div>
                    </x-card>                    
                    
                </div>

            </div>
        </div>
    </main>

@endsection

@section('modals')

    @include('webshop.customizer')

@endsection