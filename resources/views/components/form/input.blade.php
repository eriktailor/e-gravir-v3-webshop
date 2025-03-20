@props([
    'for', 
    'label' => null, 
    'type' => 'text', 
    'placeholder' => '', 
    'value' => '',
    'id' => null,
    'helptext' => null
])

<div class="form-control">
    
    @if($label)
        <x-form.label :for="$for" :helptext="$helptext">{{ $label }}</x-form.label>
    @endif

    <input 
        id="{{ $for }}" 
        name="{{ $for }}" 
        type="{{ $type }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($for, $value) }}" 
        aria-describedby="{{ $for }}-error"
        {{ $attributes->merge(['class' => 'input ' . ($errors->has($for) ? 'is-invalid' : '')]) }}
    >

    <x-form.error :for="$for" />

</div>