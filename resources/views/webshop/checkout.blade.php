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
                        
                        <!-- Szállítás -->
                        <x-card title="Szállítás" padding="p-6 lg:p-12">
                            <div class="flex flex-col gap-4">
                                <div class="form-group grid grid-cols-3 gap-4">
                                    @foreach(config('checkout.delivery_methods') as $key => $method)
                                        <x-form.radio-button 
                                            name="delivery_method"
                                            :value="$key"
                                            :icon="$method['icon']"
                                            :label="$method['label']"
                                            :info="$method['info']"
                                            :price="$method['price']"
                                            :checked="old('delivery_method') === $key"
                                        />
                                    @endforeach
                                </div>
                                <div class="form-group hidden" id="foxpostBoxSelect">
                                    <x-form.select for="delivery_foxpost_box" placeholder="Válassz csomagautómatát"/>
                                </div>
                                <div id="takeOffAddress" class="py-3 px-4 bg-green-100 text-green-600 hidden">
                                    Átvétel itt: <strong class="font-semibold">1157 Budapest, Zsókavár utca 22.</strong>
                                </div>
                                <div class="form-group">
                                    <x-form.textarea for="delivery_notes" rows="1" placeholder="Megjegyzés a szállításhoz (nem kötelező)"/>
                                </div>
                            </div>
                        </x-card>

                        <!-- Személyes -->
                        <x-card title="Személyes" padding="p-6 lg:p-12">
                            <div class="flex flex-col gap-4">
                                <div class="form-group">
                                    <x-form.input for="customer_name" placeholder="Teljes név"/>
                                </div>
                                <div class="form-group">
                                    <x-form.input for="customer_email" placeholder="Email cím" type="email"/>
                                </div>
                                <div class="form-group">
                                    <x-form.input for="customer_phone" placeholder="Telefonszám"/>
                                </div>
                                <div class="flex gap-4">
                                    <div class="form-group w-[150px] flex-none">
                                        <x-form.input for="customer_zip" placeholder="Irányítószám" type="number" min="0"/>
                                    </div>
                                    <div class="form-group grow">
                                        <x-form.input for="customer_city" placeholder="Város"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <x-form.input for="customer_address" placeholder="Utca, házszám"/>
                                </div>
                            </div>
                        </x-card>

                        <!-- Fizetés -->
                        <x-card title="Fizetés" padding="p-6 lg:p-12">
                            <div class="flex flex-col gap-4">
                                <div class="form-group grid grid-cols-3 gap-4">
                                    @foreach(config('checkout.payment_methods') as $key => $method)
                                        <x-form.radio-button 
                                            name="payment_method"
                                            :value="$key"
                                            :icon="$method['icon']"
                                            :label="$method['label']"
                                            :info="$method['info']"
                                            :checked="old('delivery_method') === $key"
                                        />
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <x-form.checkbox for="accept_terms">
                                        Elfogadom az 
                                        <a href="{{ route('page.terms') }}" class="underline underline-offset-2 text-red-600 hover:text-red-500 hover:no-underline" target="_blank">ÁSZF</a>-ben 
                                        leírtakat
                                    </x-form.checkbox>
                                </div>
                            </div>
                        </x-card>

                    </form>
                </div>
                <div class="w-[500px] flex-none">

                    <!-- Termékek -->
                    <x-card title="Összesítés" padding="p-6 lg:p-12" class="sticky top-[96px]">
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
                                                class="offcanvas-toggle text-sm text-red-600 underline underline-offset-2"
                                                data-product-id="{{ $id }}">
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
                            
                            <!-- Cart summary -->
                            @php
                                $cart = session('cart', []);
                                $productTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
                                $extraTotal = collect($cart)->sum(fn($item) => ($item['extra_price'] ?? 0) * $item['quantity']);
                                $shipping = 0; // ha van fix vagy dinamikus szállítási díj, itt állítsd
                                $grandTotal = $productTotal + $extraTotal + $shipping;
                            @endphp
                            <div class="order-summary flex flex-col gap-y-2 my-3">
                                <div class="flex justify-between">
                                    Termékek
                                    <span>{{ number_format($productTotal, 0, ',', ' ') }} Ft</span>
                                </div>
                                <div class="flex justify-between">
                                    Extra felár
                                    <span>{{ number_format($extraTotal, 0, ',', ' ') }} Ft</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-300 mb-2 pb-4">
                                    Szállítási díj
                                    <span>{{ number_format($shipping, 0, ',', ' ') }} Ft</span>
                                </div>
                                <div class="flex justify-between text-stone-950 mb-1">
                                    <strong>Végösszeg</strong>
                                    <span>{{ number_format($grandTotal, 0, ',', ' ') }} Ft</span>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            const formatFt = num => new Intl.NumberFormat('hu-HU').format(num) + ' Ft';

            $('input[name="delivery_method"]').on('change', function () {
                const shipping = parseInt($(this).data('price')) || 0;

                const productTotal = parseInt({{ $productTotal }});
                const extraTotal = parseInt({{ $extraTotal }});
                const grandTotal = productTotal + extraTotal + shipping;

                $('.order-summary span').eq(2).text(formatFt(shipping)); // Szállítási díj
                $('.order-summary span').eq(3).text(formatFt(grandTotal)); // Végösszeg
            });
        });
    </script>
@endpush

