@props([
    'for',
    'label' => null,
    'checked' => false,
])

<div class="form-control">
    <div class="inline-flex items-center relative -left-3">
        <label class="relative flex cursor-pointer items-center rounded-full p-3" for="{{ $for }}">
            <input 
                id="{{ $for }}" 
                name="{{ $for }}" 
                type="checkbox" 
                value="1"
                @if($checked) checked @endif
                class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-gray-300 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-red-600 checked:bg-red-600 checked:before:bg-red-600 hover:before:opacity-10"/>
            <div class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1" > <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" ></path> </svg>
            </div>
        </label>
        <label class="mt-px cursor-pointer select-none font-light text-gray-500 text-sm" for="{{ $for }}">
            {{ $label }}
        </label>
    </div>

    <x-form.error :for="$for" />
</div>

