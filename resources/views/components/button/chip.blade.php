<a {{ $attributes->merge([
    'type' => 'button', 
    'href' => $href ?? '#',
    'class' => 'rounded-full block p-1 text-gray-400 cursor-pointer hover:bg-gray-100 hover:text-gray-600 transition duration-200']) }}>
    <x-icon name="{{ $icon }}" class="w-6 h-6" />
</a>