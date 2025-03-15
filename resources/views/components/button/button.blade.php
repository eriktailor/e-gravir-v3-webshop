@props([
    'href' => null,
    'size' => null,
    'color' => 'primary',
    'disabled' => false,
])

@php
    $btnClasses = 'button font-semibold text-base no-underline 
                   whitespace-nowrap text-center inline-block enabled:hover:scale-[1.025] 
                   transition duration-100 cursor-pointer';
                   
    $btnClasses .= $size === 'small' 
        ? ' rounded py-1 px-2.5 text-sm' 
        : ' rounded-lg py-2.5 px-5';
    
    $buttonColors = $color === 'white' 
        ? 'bg-white text-slate-900 hover:bg-gray-100 border shadow' 
        : 'bg-red-600 hover:bg-red-500 text-white enabled:hover:bg-red-600';

    if ($disabled) {
        $btnClasses .= ' cursor-not-allowed bg-stone-300 pointer-events-none';
    }
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "$btnClasses $buttonColors"]) }} @if($disabled) aria-disabled="true" tabindex="-1" @endif>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "$btnClasses $buttonColors"]) }} @if($disabled) disabled @endif>
        {{ $slot }}
    </button>
@endif
