@props([
    'for',
    'label' => null,
    'placeholder' => null,
    'helptext' => null
])

<div class="form-control">
    
    @if($label)
        <x-form.label :for="$for" :helptext="$helptext">{{ $label }}</x-form.label>
    @endif

    <textarea 
        id="{{ $for }}" 
        name="{{ $for }}" 
        placeholder="{{ old($for) ?: $placeholder }}" 
        aria-describedby="{{ $for }}-error"
        {{ $attributes->merge(['class' => 'input ' . ($errors->has($for) ? ' is-invalid' : '')]) }}
    >{{ old($for, $slot) }}</textarea>

    <x-form.error :for="$for" />
    
</div>
