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
    if ($color == 'warning') {
        $color_classes = 'bg-amber-100 text-amber-500';
    }
    if ($color == 'danger') {
        $color_classes = 'bg-red-100 text-red-500';
    }
@endphp

<span {{ $attributes->merge(['class' => 'px-2 py-1 text-xs font-medium rounded-md whitespace-nowrap ' . $color_classes]) }}>
    {{ $slot }}
</span>     