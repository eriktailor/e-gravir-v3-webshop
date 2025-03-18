@props([
    'title' => null
])

<div class="card p-12 bg-white rounded-2xl shadow-sm shadow-amber-700/20 break-inside-avoid mb-6">

    @if($title)
        <x-heading level="h3" class="mb-8">{{ $title }}</x-heading>
    @endif

    {{ $slot }}

</div>