@props([
    'for', 
    'label' => null, 
    'id' => null,
    'helptext' => null,
    'config' => []
])

@php
    $defaultConfig = [
        'labelIdle' => 'Húzd ide a képeidet vagy <span class="filepond--label-action"> kiválasztás </span>',
        'credits' => false,
    ];

    $finalConfig = array_merge($defaultConfig, $config);
@endphp

<div class="form-control">
    
    @if($label)
        <x-form.label :for="$for" :helptext="$helptext">{{ $label }}</x-form.label>
    @endif

    <input 
        type="file" 
        name="{{ $for }}" 
        id="{{ $id }}" 
        {{ $attributes }}
    >

    <x-form.error :for="$for" />

</div>

@once('filepond')
    @push('styles')
        <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    @endpush
@endonce

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pond = FilePond.create(document.getElementById('{{ $id }}'), {!! json_encode($finalConfig) !!});
        });
    </script>
@endpush