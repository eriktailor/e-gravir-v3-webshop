@props([
    'for',
    'label' => null
])

@if($label)
    <label for="{{ $for }}" class="form-label block mb-1 text-sm text-gray-500">
        {{ $slot }}
        @if($helptext)
            <x-tooltip text="{{ $helptext}}" class="top-[3px] -left-0.5">
                <x-icon name="info-circle" class="w-4 h-4 text-gray-400/80"/>
            </x-tooltip>
        @endif
    </label>
@endif