<div class="tooltip relative flex" {{ $attributes }}>
    <div class="relative">

        <!-- Tooltip -->
        <div class="tooltip-text absolute hidden opacity-0 bottom-full left-1/2 -translate-x-1/2 transition-all 
                    duration-200 mb-2 bg-gray-900 text-white text-sm font-medium py-1 px-2 rounded shadow-md whitespace-nowrap">
            {{ $text }}
            <div class="absolute left-1/2 -translate-x-1/2 top-full border-6 border-transparent border-t-gray-900"></div>
        </div>

        <!-- Trigger -->
        <div class="tooltip-trigger inline-flex">
            {{ $slot }}
        </div>

    </div>
</div>