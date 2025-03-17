<div class="form-control">

    <label for="{{ $for }}" class="flex items-center space-x-2 cursor-pointer mb-0">

        <input
            id="{{ $for }}" 
            name="{{ $for }}" 
            type="checkbox" 
            value="1"
            aria-describedby="{{ $for }}-error"
            {{ old($for, $value ?? '') == 1 ? 'checked' : '' }}
            {{ $attributes->merge(['class' => $errors->has($for) ? 'border-red-500' : '']) }}
        >

        @if(isset($label) && $label)
            <span class="text-gray-500 text-sm">{{ $label }}</span>
        @endif

    </label>  

    <x-form.error :for="$for" />

</div>
