@props([
    'name',
    'value',
    'icon' => null,
    'label',
    'info' => null,
    'price' => null,
    'checked' => false,
])

<label class="border border-gray-300 hover:border-stone-950 cursor-pointer rounded-lg flex flex-col items-center text-center px-4 py-6 transition duration-300 has-checked:border-stone-950">
    <input 
        class="hidden" 
        type="radio" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        data-price="{{ $price }}" 
        {{ $checked ? 'checked' : '' }}>
    
    @if($icon)
        <x-icon name="{{ $icon }}" class="text-red-600 w-8 h-8 mb-3" stroke-width="1.5"/>
    @endif

    <p class="text-stone-950 font-normal mb-1">{{ $label }}</p>

    @if($info)
        <p class="text-sm text-gray-400 font-normal">({{ $info }})</p>
    @endif
</label>
