@props([
    'for',
    'helptext' => null
])


<label for="{{ $for }}" {{ $attributes->merge(['class' => 'form-label block text-sm text-gray-500 leading-6']) }}>
    {{ $slot }}
    @if($helptext)
        <x-tooltip text="{{ $helptext}}" class="top-[3px] -left-0.5">
            <x-icon name="info-circle" class="w-4 h-4 text-gray-400/80"/>
        </x-tooltip>
    @endif
</label>
