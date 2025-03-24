<header {{ $attributes->merge(['class' => 'text-center relative h-[500px]'])}}>
    <img src="{{ $image }}" 
         alt="{{ $title }}"
         class="w-full object-cover object-bottom fixed left-0 top-[72px] h-[500px]">
    <div class="container h-full flex flex-col items-center justify-center z-30 relative gap-y-12">
        <x-heading level="h1" class="text-6xl text-white w-full [text-shadow:0px_0px_25px_black,0px_0px_3px_yellow]">
            {!! $title !!}
        </x-heading>
        <p class="text-xl text-white/90 [text-shadow:0px_0px_15px_black] w-[800px] font-normal leading-8">{{ $description }}</p>
    </div>
</header>
