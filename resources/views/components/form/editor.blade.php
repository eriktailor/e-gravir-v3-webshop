@props([
    'for',
    'label' => null,
    'placeholder' => null,
])

<div class="form-group">
    
    @if(isset($label) && $label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif

    <!-- Visible div editor -->
    <div 
        id="{{ $for }}-editor" 
        class="editor font-normal"
        contenteditable="true"
    >{!! old($for, $slot) !!}</div>

    <!-- Hidden textarea to sync -->
    <textarea 
        id="{{ $for }}" 
        name="{{ $for }}" 
        class="hidden" 
        aria-describedby="{{ $for }}-error"
    >{!! old($for, $slot) !!}</textarea>
    
    <x-form.error :for="$for" />
    
</div>

@once('easyeditor')
    @push('scripts')
        @vite(['resources/js/easyeditor.js'])
    @endpush
@endonce