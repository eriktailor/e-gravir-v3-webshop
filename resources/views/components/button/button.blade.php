@props([
    'href' => null,
    'size' => null,
    'color' => 'primary',
    'disabled' => false,
])

@php
    $btnClasses = 'button font-semibold text-base no-underline 
                   whitespace-nowrap text-center inline-block 
                   transition duration-100 cursor-pointer leading-7 inline-block';
                   
    $btnClasses .= $size === 'small' 
        ? ' rounded-md py-1.5 px-2.5 text-sm' 
        : ' rounded-lg py-2.5 px-5 h-[50px] min-w-32';
    
    $buttonColors = $color === 'white' 
        ? 'bg-white text-gray-600 hover:bg-gray-50 hover:text-stone-950 border border-gray-300 shadow-sm shadow-gray-200/50' 
        : 'bg-red-600 hover:bg-red-500 text-white';

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
