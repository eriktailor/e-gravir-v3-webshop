@props([
    'for', 
    'label' => null, 
    'type' => 'text', 
    'placeholder' => '', 
    'value' => '',
    'id' => null,
])

@php
    $inputId = $id ?? $for;
@endphp

<div class="form-control">
    
    @if($label)
        <label for="{{ $inputId }}" class="form-label">{{ $label }}</label>
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