@extends('layouts.shop')

@section('title', 'Pénztár')

@section('content')

    <x-header.page :title="'Megrendelés'"/>

    <main>
        <div class="container">
            <div class="grid grid-cols-2 gap-12">

                <div>

                    <!-- Termékek -->
                    <x-card title="Termékek">
                        <div class="cart-items flex flex-col gap-y-4">
                            @forelse(session('cart', []) as $id => $item)
                                @for ($i = 0; $i < $item['quantity']; $i++)
                                    <div class="cart-item border border-gray-300 p-4 rounded-lg flex gap-x-3">
                                        <img src="{{ $item['image'] ?? asset('/img/noimage.webp') }}" 
                                            class="w-18 h-18 object-cover object-center rounded-lg"
                                            alt="{{ $item['name'] }}" 
                                            class="w-full h-full object-cover rounded-lg" />
                                        <div class="w-4/5 flex flex-col justify-between">
                                            <x-heading level="h4" class="mb-2">
                                                {{ $item['name'] }}
                                            </x-heading>
                                            <a href="#productCustomizeModal" 
                                                class="modal-toggle text-sm text-red-600 underline underline-offset-2">
                                                Testreszabás
                                            </a>
                                        </div>
                                        <div class="w-1/5 flex flex-col justify-between items-end">
                                            <x-tooltip text="Törlés">
                                                <x-button.chip icon="trash" class="remove-cart-item -mt-2.5 -mr-2" data-id="{{ $id }}"/>
                                            </x-tooltip>
                                            <p class="text-sm text-gray-400">
                                                {{ $item['price'] }} Ft
                                            </p>
                                        </div>
                                    </div>
                                @endfor
                            @empty
                                <p>Nincs termék a kosárban.</p>
                            @endforelse
                        </div>
                    </x-card>

                    <!-- Személyes -->
                    <x-card title="Személyes">
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

                    <!-- Szállítás -->
                    <x-card title="Szállítás">
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
                            <div class="form-group">
                                <x-form.select for="delivery_foxpost_box" placeholder="Válassz csomagautómatát">

                                </x-form.select>
                            </div>
                            <div class="form-group">
                                <x-form.textarea for="delivery_notes" rows="1" placeholder="Megjegyzés a szállításhoz (nem kötelező)"/>
                            </div>
                        </div>
                    </x-card>

                </div>
                <div>

                    <!-- Fizetés -->
                    <x-card title="Fizetés">
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
                            <div class="order-summary flex flex-col gap-y-2">
                                <div class="flex justify-between">
                                    Termékek
                                    <span>0 Ft</span>
                                </div>
                                <div class="flex justify-between">
                                    Extra felár
                                    <span>0 Ft</span>
                                </div>
                                <div class="flex justify-between">
                                    Szállítási díj
                                    <span>0 Ft</span>
                                </div>
                                <div class="flex justify-between text-stone-950">
                                    <strong>Végösszeg</strong>
                                    <span>0 Ft</span>
                                </div>
                            </div>
                        </div>
                    </x-card>
                    
                </div>

            </div>
        </div>
    </main>

@endsection

@section('modals')

    <x-modal id="productCustomizeModal" title="Testreszabás" size="medium">
        <form action="" method="POST" id="productCustomizeForm" class="flex flex-col gap-y-4" novalidate>
            @csrf
            <div class="form-group">
                <x-form.upload 
                    for="front_image" 
                    id="customizeFrontImage" 
                    label="Előlap képe"
                    multiple 
                    :config="['allowMultiple' => false, 'maxFiles' => 1]"
                />
            </div>
            <div class="form-group">
                <x-form.input label="Előlap szöveg" for="customizeFrontText"/>
            </div>
            <div class="form-group">
                <x-form.upload 
                    for="front_image" 
                    id="customizeBackImage" 
                    label="Hátlap képe"
                    multiple 
                    :config="['allowMultiple' => false, 'maxFiles' => 1]"
                />
            </div>
            <div class="form-group">
                <x-form.input label="Hátlap szöveg" for="customizeBackText"/>
            </div>
            <div class="form-group">
                <x-form.input label="Belső szöveg" for="customizeBackText"/>
            </div>
            <div class="form-group">
                <x-form.textarea label="Egyéb instrukció" for="customizeBackText" rows="4"/>
            </div>
        </form>
        <x-slot name="footer">
            <x-button class="w-full">Elmentem</x-button>
        </x-slot>
    </x-modal>

@endsection