<header class="py-16 mx-auto" {{ $attributes}}>
    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            @isset($button)
                <x-heading level="h1">
                    {!! $title !!}
                </x-heading>
                <div class="ml-4">
                    {{ $button }}
                </div>
            @else
                <x-heading level="h1" class="text-center w-full">
                    {!! $title !!}
                </x-heading>
            @endisset
        </div>
    </div>
</header>
