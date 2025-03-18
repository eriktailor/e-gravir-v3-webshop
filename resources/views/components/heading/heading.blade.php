@props([
    'level' => 'h3',
    'class' => '',
])

@php
    $defaultClasses = [
        'h1' => 'font-semibold text-stone-950 text-5xl leading-[56px] tracking-tighter',
        'h2' => 'font-semibold text-stone-950 text-2xl leading-[32px] tracking-tight',
        'h3' => 'font-semibold text-stone-950 text-xl leading-[28px] tracking-tight',
        'h4' => 'font-semibold text-stone-950 text-base leading-[22px]',
    ];

    $finalClass = ($defaultClasses[$level] ?? '') . ' ' . $class;
@endphp

<{{ $level }} {{ $attributes->merge(['class' => trim($finalClass)]) }}>
    {{ $slot }}
</{{ $level }}>
