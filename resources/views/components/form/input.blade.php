@props([
    'for', 
    'label' => null, 
    'type' => 'text', 
    'placeholder' => '', 
    'value' => '',
    'id' => null,
    'helptext' => null
])

@php
    $inputId = $id ?? $for;
@endphp

<div class="form-control">
    
    @if($label)
        <label for="{{ $inputId }}" class="form-label">
            {{ $label }}
            @if($helptext)
                <x-tooltip text="{{ $helptext}}" class="top-[3px] -left-0.5">
                    <x-icon name="info-circle" class="w-4 h-4 text-gray-400/80"/>
                </x-tooltip>
            @endif
        </label>
    @endif

    <input 
        id="{{ $inputId }}" 
        name="{{ $for }}" 
        type="{{ $type }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($for, $value) }}" 
        aria-describedby="{{ $inputId }}-error"
        {{ $attributes->merge(['class' => 'input ' . ($errors->has($for) ? 'is-invalid' : '')]) }}
    >

    <x-form.error :for="$for" />

</div>