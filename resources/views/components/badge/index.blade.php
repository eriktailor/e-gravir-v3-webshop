@props([
    'color' => 'default'
])

@php
    if ($color == 'default') {
        $color_classes = 'bg-gray-200 text-gray-500';
    }
    if ($color == 'success') {
        $color_classes = 'bg-green-100 text-green-600';
    }
@endphp

<span {{ $attributes->merge(['class' => 'px-2 py-1 text-xs rounded-md whitespace-nowrap ' . $color_classes]) }}>
    {{ $slot }}
</span>     