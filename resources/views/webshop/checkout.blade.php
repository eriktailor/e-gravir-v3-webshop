@extends('layouts.shop')

@section('title', 'Pénztár')

@section('content')

    <x-header.page :title="'Megrendelés'"/>

    <main>
        <div class="container">
            <div class="max-w-2xl">

                <!-- Termékek -->
                <x-card title="Termékek">
                    <div class="flex flex-col gap-4">
                       
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
    </main>

@endsection
