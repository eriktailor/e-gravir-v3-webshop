@props([
    'for',
    'label' => null,
    'placeholder' => null,
    'isPreSelected' => false,
])

<div class="form-control">
    
    @if(isset($label) && $label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif

    <div class="relative">
        <select 
            name="{{ $for }}" 
            id="{{ $for }}" 
            aria-describedby="{{ $for }}-error"
            {{ $attributes->merge([
                'class' => 'input' . ($errors->has($for) ? ' is-invalid' : '') . 
                (($isPreSelected && old($for)) ? '' : ' text-gray-400')
            ]) }}
        >
            @if ($placeholder)
                <option disabled {{ old($for) || $isPreSelected ? '' : 'selected' }} value="">
                    {{ $placeholder }}
                </option>
            @endif
            {{ $slot }}
        </select>

        <!-- Dropdown Icon -->
        <x-icon 
            class="pointer-events-none absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400" 
            name="chevron-down" 
            width="20" 
            height="20"
            aria-hidden="true"
        />
    </div>

    <x-form.error :for="$for" />
    
</div>
