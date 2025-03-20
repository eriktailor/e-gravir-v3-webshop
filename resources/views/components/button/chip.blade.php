
@props([
    'href' => null,
    'icon' => null
])

@php
    $classes = 'rounded-full block p-1 text-gray-400 cursor-pointer hover:bg-gray-100 hover:text-gray-600 transition duration-200';
@endphp

@if($href)
    <a {{ $attributes->merge([
        'type' => 'button', 
        'href' => $href ?? '#',
        'class' => $classes]) }}>
        <x-icon name="{{ $icon }}" class="w-7 h-7 p-1" />
    </a>
@else
    <button {{ $attributes->merge([
        'type' => 'button', 
        'class' => $classes]) }}>
        <x-icon name="{{ $icon }}" class="w-7 h-7 p-1" />
    </button>
@endif