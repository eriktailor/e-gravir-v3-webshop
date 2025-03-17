<header class="py-16 mx-auto" {{ $attributes}}>
    <div class="container mx-auto">
        <div class="flex justify-between items-center">
            @isset($button)
                <h1 class="text-4xl">
                    {{ $title }}
                </h1>
                <div class="ml-4">
                    {{ $button }}
                </div>
            @else
                <h1 class="text-4xl text-center w-full">
                    {{ $title }}
                </h1>
            @endisset
        </div>
    </div>
</header>
