<div class="form-control">

    <label for="{{ $for }}" class="flex items-center space-x-2 cursor-pointer">

        <input
            id="{{ $for }}" 
            name="{{ $for }}" 
            type="checkbox" 
            value="{{ old($for, $value ?? '') }}" 
            aria-describedby="{{ $for }}-error"
            {{ $attributes->merge(['class' => $errors->has($for) ? 'border-red-500' : '']) }}
        >

        @if(isset($label) && $label)
            <span class="text-gray-500 text-sm">{{ $label }}</span>
        @endif

    </label>  

    @error($for)
        <p id="{{ $for }}-error" class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

</div>
