@props([
    'title' => 'Modal',
    'size' => 'small', // small, medium, fullscreen
])


@php
    $sizes = [
        'small' => 'sm:w-[500px]',
        'medium' => 'sm:w-[700px]',
        'fullscreen' => 'sm:w-full',
    ];
@endphp

<div class="modal fixed inset-0 z-50 transition-opacity duration-300 flex h-screen items-start lg:items-center invisible opacity-0" {{ $attributes }}>

    <!-- BACKDROP -->
    <div class="modal-backdrop absolute inset-0 bg-stone-950/50 opacity-0 transition-opacity duration-100"></div>

    <!-- PANEL -->
    <div class="modal-panel mx-auto h-full md:h-auto w-full transform scale-75 transition-transform duration-200 ease-in-out p-8 {{ $sizes[$size] ?? $sizes['small'] }}">
        <div class="bg-white rounded-xl h-full flex flex-col">

            <!-- Header -->
            <div class="modal-header p-6">
                <div class="flex justify-between">
                    <x-heading level="h2">{{ $title }}</x-heading>
                    <x-button.chip icon="x" class="close-modal"/>
                </div>
            </div>

            <!-- Content -->
            <div class="modal-content px-6 overflow-auto no-scrollbar">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @isset($footer)
                <div class="modal-footer p-6">
                    {{ $footer }}
                </div>
            @endisset

        </div>
    </div>
</div>