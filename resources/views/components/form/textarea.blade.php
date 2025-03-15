@props([
    'for',
    'label' => null,
    'placeholder' => null,
])

<div class="form-group">
    
    @if(isset($label) && $label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif

    <textarea 
        id="{{ $for }}" 
        name="{{ $for }}" 
        placeholder="{{ old($for) ?: $placeholder }}" 
        aria-describedby="{{ $for }}-error"
        {{ $attributes->merge(['class' => 'input' . ($errors->has($for) ? ' is-invalid' : '')]) }}
    >{{ old($for, $slot) }}</textarea>

    @error($for)
        <span id="{{ $for }}-error" class="error-message">{{ $message }}</span>
    @enderror
    
</div>
