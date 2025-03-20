@props([
    'for',
    'label' => null,
    'checked' => false,
])

<div class="form-control">
    
    <label for="{{ $for }}" class="flex items-center gap-5 cursor-pointer select-none">
        <div class="relative inline-flex">
            <input 
                id="{{ $for }}" 
                name="{{ $for }}" 
                type="checkbox" 
                value="1"
                @if($checked) checked @endif
                class="peer appearance-none h-5 w-5 border-2 border-gray-400 rounded-sm checked:bg-stone-950 checked:border-stone-950 transition-colors"
            >
            <!-- Check icon -->
            <svg class="absolute w-3 h-3 text-white hidden peer-checked:block left-1 top-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
    
        <span class="text-sm text-gray-500 font-semibold inline-block">{{ $label }}</span>
    </label>
    

    <x-form.error :for="$for" />

</div>
