@props([
    'for',
    'label' => null,
    'checked' => false,
    'helptext' => null,
])

<div class="form-control">
    <div class="flex justify-between relative">

        @if($label)
            <x-form.label :for="$for" :helptext="$helptext" class="mb-0">{{ $label }}</x-form.label>
        @endif

        <label class="relative inline-flex cursor-pointer items-center">
            <input  
                id="{{ $for }}"
                name="{{ $for }}" 
                type="checkbox" 
                class="peer sr-only"
                @if($checked) checked @endif/>
            <div class="peer h-6 w-11 rounded-full bg-gray-300 after:absolute after:left-[2px] 
                        after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white 
                        after:transition-all after:content-[''] peer-checked:bg-green-500 peer-checked:after:translate-x-full 
                        peer-checked:after:border-white peer-focus:ring-green-300"></div>
        </label>

    </div>

    <x-form.error :for="$for" />
</div>

