@extends('layouts.auth')

@section('title', 'Belépés')

@section('content')

    <form class="flex flex-col justify-center items-start h-full w-full max-w-xs" method="POST" action="{{ route('admin.login') }}" novalidate>
        @csrf
        <div class="w-full">
            <img class="mb-6" src="{{ asset('img/logos/logo_emblem.svg') }}" alt="E-Gravír logó" width="40">
            <x-heading level="h1" class="mb-4">Belépés</x-heading>
            <div class="mb-4">
                <x-form.input for="email" placeholder="Email" type="text" value="{{ old('email') }}"/>
            </div>
            <div class="mb-4">
                <x-form.input for="password" placeholder="Jelszó" type="password"/>
            </div>
            <x-button class="w-full" type="submit">Belépés</x-button>
        </div>
    </form>

@endsection
