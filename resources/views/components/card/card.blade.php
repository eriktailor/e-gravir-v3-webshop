@props([
    'title' => null,
    'description' => null,
    'padding' => 'p-6'
])

<div {{ $attributes->merge(['class' => "card $padding bg-white rounded-2xl shadow-sm shadow-amber-700/20 break-inside-avoid mb-6"]) }}>
    
    @if($title || $description)
        <div class="card-header mb-8">
            @if($title)
                <x-heading level="h3" class="mb-3">{{ $title }}</x-heading>
            @endif

            @if($description)
                <p>{{ $description }}</p>
            @endif
        </div>
    @endif

    {{ $slot }}

</div>