<div class="form-control">
    
    @if(isset($label) && $label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif

    <input 
        id="{{ $for }}" 
        name="{{ $for }}" 
        type="{{ $type ?? 'text' }}" 
        placeholder="{{ $placeholder ?? '' }}" 
        value="{{ old($for, $value ?? '') }}" 
        aria-describedby="{{ $for }}-error"
        {{ $attributes->merge(['class' => 'input ' . ($errors->has($for) ? 'is-invalid' : '')]) }}
    >

    <x-form.error :for="$for" />

</div>
