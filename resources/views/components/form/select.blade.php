@props([
    'for',
    'label' => null,
    'placeholder' => null,
    'isPreSelected' => false,
    'helptext' => null
])

<div class="form-control">
    
    <x-form.label :for="$for"/>

    <div class="relative">
        <select 
            name="{{ $for }}" 
            id="{{ $for }}" 
            aria-describedby="{{ $for }}-error"
            {{ $attributes->merge([
                'class' => 'input select ' . ($errors->has($for) ? ' is-invalid' : '') . 
                (($isPreSelected && old($for)) ? '' : ' text-gray-400')
            ]) }}
        >
            @if ($placeholder)
                <option disabled {{ old($for) || $isPreSelected ? '' : 'selected' }} value="" class="placeholder">
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
