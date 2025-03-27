@props([
    'alignment' => 'right'
])

<div {{ $attributes->merge(['class' => 'dropdown relative inline-block']) }}>

    <!-- Toggle -->
    <div class="dropdown-toggle cursor-pointer transition-all" role="button" aria-haspopup="true" aria-expanded="false">
        {{ $trigger }}
    </div>

    <!-- Menu -->
    <div class="dropdown-menu hidden transform scale-95 opacity-0 transition-all duration-200 origin-top-right bg-white border 
             border-gray-300 rounded-lg shadow-lg p-2 flex flex-col z-10 absolute top-full mt-1 w-[150px] z-50 {{ $alignment === 'left' ? 'left-0' : 'right-0' }}">
        {{ $slot }}
    </div>

</div>
