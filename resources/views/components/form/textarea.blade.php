<div class="form-group">
    <textarea 
        id="{{ $for }}" 
        name="{{ $for }}" 
        placeholder="{{ old($for) ? '' : $placeholder }}" 
        {{ $attributes->merge(['class' => 'input' . ($errors->has($for) ? ' is-invalid' : '')]) }}
    >{{ $slot }}</textarea>
    @error($for)
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>