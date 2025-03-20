@props([
    'for',
    'label' => null,
    'helptext' => null
])

<div class="form-group">
    
    @if($label)
        <x-form.label :for="$for" :helptext="$helptext">{{ $label }}</x-form.label>
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