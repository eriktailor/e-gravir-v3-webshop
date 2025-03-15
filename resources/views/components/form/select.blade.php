@props([
    'for',
    'placeholder' => null,
    'isPreSelected' => false,
])

<div class="form-group">
    <div class="relative">
        <select 
            name="{{ $for }}" 
            id="{{ $for }}" 
            value="{{ old($for) }}" 
            {{ $attributes->merge([
                'class' => 'input' . ($errors->has($for) ? ' is-invalid' : '') . ($isPreSelected && old($for) ? '' : ' placeholder')
            ]) }}
        >
            @if ($placeholder)
                <option disabled {{ old($for) || $isPreSelected ? '' : 'selected' }} value="">
                    {{ $placeholder }}
                </option>
            @endif
            {{ $slot }}
        </select>
        <x-icon class="pointer-events-none absolute right-4 top-4 text-slate-500" name="chevron-down" width="20" height="20"/>
    </div>

    @error($for)
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>
