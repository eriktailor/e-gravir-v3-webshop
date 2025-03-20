@props([
    'for',
    'label' => null,
])

<div class="form-group">
    
    @if(isset($label) && $label)
        <label for="{{ $for }}" class="form-label">{{ $label }}</label>
    @endif

    <div id="editor" class="pell"></div>

    <textarea 
        id="hiddenTextarea" 
        name="{{ $for }}" 
        class="hidden"
    ></textarea>
    
</div>

@once('editor')
    @push('scripts')
        @vite([
            'resources/js/pell.js', 
        ])
    @endpush
@endonce