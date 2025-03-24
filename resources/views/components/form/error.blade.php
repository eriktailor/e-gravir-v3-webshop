@props(['for'])

@error($for)
    <span id="{{ $for }}-error" {{ $attributes->merge(['class' => 'error-message text-red-500 text-sm font-medium']) }}>
        {{ $message }}
    </span>
@enderror
