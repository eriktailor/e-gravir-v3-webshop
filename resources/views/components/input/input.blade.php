<div class="form-group">
    <input 
        id="{{ $for }}" 
        name="{{ $for }}" 
        type="{{ $type }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($for) }}" 
        {{ $attributes->merge(['class' => $errors->has($for) ? 'input is-invalid' : 'input']) }}
    >

    @error($for)
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>
