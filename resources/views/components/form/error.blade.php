@props(['for'])

@error($for)
    <span id="{{ $for }}-error" class="error-message text-red-500 text-sm font-medium">{{ $message }}</span>
@enderror
