@props([
    'title' => null
])

<div class="p-8 bg-white rounded-lg break-inside-avoid mb-6">

    @if($title)
        <x-heading level="h3" class="mb-8">{{ $title }}</x-heading>
    @endif

    {{ $slot }}

</div>