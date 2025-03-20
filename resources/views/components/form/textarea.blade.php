@props([
    'for',
    'label' => null,
    'placeholder' => null,
    'helptext' => null
])

<div class="form-group">
    
    <x-form.label :for="$for"/>

    <textarea 
        id="{{ $for }}" 
        name="{{ $for }}" 
        placeholder="{{ old($for) ?: $placeholder }}" 
        aria-describedby="{{ $for }}-error"
        {{ $attributes->merge(['class' => 'input' . ($errors->has($for) ? ' is-invalid' : '')]) }}
    >{{ old($for, $slot) }}</textarea>

    <x-form.error :for="$for" />
    
</div>
