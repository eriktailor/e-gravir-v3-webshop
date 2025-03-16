@props([
    'alignment' => 'right'
])

<div class="dropdown relative inline-block" {{ $attributes }}>

    <!-- Toggle -->
    <div class="dropdown-toggle cursor-pointer p-2 transition-all" role="button" aria-haspopup="true" aria-expanded="false">
        {{ $trigger }}
    </div>

    <!-- Menu -->
    <div class="dropdown-menu hidden transform scale-95 opacity-0 transition-all duration-200 origin-top-right bg-white border 
             border-gray-300 rounded-lg shadow-lg p-2 flex flex-col z-10 absolute top-full mt-2 w-[150px] {{ $alignment === 'left' ? 'left-0' : 'right-0' }}">
        {{ $slot }}
    </div>

</div>
