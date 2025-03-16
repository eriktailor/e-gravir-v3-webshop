<div class="dropdown relative flex items-center" {{ $attributes }}>

    <!-- Toggle Button Slot -->
    <div class="dropdown-toggle cursor-pointer p-2 transition-all">
        {{ $trigger }}
    </div>

    <!-- Dropdown Menu -->
    <div class="dropdown-menu overflow-y-auto fixed left-0 top-0 overflow-auto h-screen max-w-unset w-[150px] sm:h-auto sm:left-auto sm:absolute 
                right-0 gap-y-1 sm:top-full hidden transform scale-95 opacity-0 transition-all duration-200 origin-top-right bg-white border 
                border-gray-300 rounded-lg shadow-lg p-2 flex flex-col z-10">
        {{ $slot }}
    </div>
</div>
