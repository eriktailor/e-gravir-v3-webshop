@extends('layouts.shop')

@section('title', 'Pénztár')

@section('content')

    <x-header.page :title="'Megrendelés'"/>

    <main>
        <div class="container">
            <div class="max-w-2xl">

                <!-- Személyes -->
                <x-card title="Személyes adatok">
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
                <x-card title="Szállítási mód">
                    <div class="flex flex-col gap-4">
                        <div class="grid grid-cols-3 gap-4">
                            <label class="border border-gray-300 hover:border-stone-950 cursor-pointer rounded-lg flex flex-col items-center text-center px-4 py-6">
                                <input type="radio" name="delivery_method" value="foxpost" data-price="1500">
                                <x-icon name="inbox" class="text-red-600 w-8 h-8 mb-3"/>
                                <p class="text-stone-950 font-medium mb-1">Foxpost autómata</p>
                                <p class="text-sm text-gray-400">(1500 Ft)</p>
                            </label>
                            <label class="border border-gray-300 hover:border-stone-950 cursor-pointer rounded-lg flex flex-col items-center text-center px-4 py-6">
                                <input type="radio" name="delivery_method" value="hazhozszallitas" data-price="2500">
                                <x-icon name="truck" class="text-red-600 w-8 h-8 mb-3"/>
                                <p class="text-stone-950 font-medium mb-1">Házhozszállítás</p>
                                <p class="text-sm text-gray-400">(2500 Ft)</p>
                            </label>
                            <label class="border border-gray-300 hover:border-stone-950 cursor-pointer rounded-lg flex flex-col items-center text-center px-4 py-6">
                                <input type="radio" name="delivery_method" value="szemelyes" data-price="1500">
                                <x-icon name="user-circle" class="text-red-600 w-8 h-8 mb-3"/>
                                <p class="text-stone-950 font-medium mb-1">Személyes átvétel</p>
                                <p class="text-sm text-gray-400">(Budapest)</p>
                            </label>
                        </div>
                    </div>
                </x-card>

            </div>
        </div>
    </main>

@endsection
