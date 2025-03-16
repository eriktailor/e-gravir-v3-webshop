@props(['for'])

@error($for)
    <span id="{{ $for }}-error" class="text-red-500 text-sm font-medium">{{ $message }}</span>
@enderror
