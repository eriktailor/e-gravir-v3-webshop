<div class="variation-item flex flex-col gap-4 border border-gray-300 p-6 rounded-lg mb-3">
    <div class="edit-variation flex flex-col gap-4">
        <div class="form-group">
            <x-form.input 
                for="variations[{{ $index }}][name]" 
                label="Típus" 
                value="{{ $variation->name ?? '' }}" 
                placeholder="Pl. Méret" 
                type="text" />
        </div>
        <div class="form-group">
            <x-form.input 
                for="variations[{{ $index }}][value]" 
                label="Érték" 
                value="{{ $variation->value ?? '' }}" 
                placeholder="Pl. Közepes" 
                type="text" />
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div class="form-group">
                <x-form.input 
                    for="variations[{{ $index }}][price]" 
                    label="Egyedi ár" 
                    value="{{ $variation->price ?? '' }}" 
                    type="number" />
            </div>
            <div class="form-group">
                <x-form.input 
                    for="variations[{{ $index }}][in_stock]" 
                    label="Készlet" 
                    value="{{ $variation->in_stock ?? 0 }}" 
                    type="number" />
            </div>
        </div>
        <div class="form-group self-end">
            <button type="button" class="remove-variation text-red-500">Törlés</button>
        </div>
    </div>
</div>
