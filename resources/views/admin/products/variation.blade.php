<div class="variation-item flex flex-col gap-4 border border-gray-300 p-6 rounded-lg mb-3" data-index="{{ $index }}">
    <div class="edit-variation flex flex-col gap-4">

        {{-- Select for Variation Type --}}
        <div class="form-group">
            <x-form.select for="variations[{{ $index }}][name]" label="Típus" placeholder="Válassz" required>
                @foreach($options as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </x-form.select>
        </div>

        {{-- Container for values --}}
        <div class="variation-values flex flex-col gap-3" data-index="{{ $index }}">
            {{-- One initial row --}}
            <div class="flex gap-6 variation-value-row">
                <div class="form-group grow">
                    <input 
                        type="text" 
                        name="variations[{{ $index }}][values][0][value]" 
                        class="input variation-value-input" 
                        placeholder="Érték (pl. Közepes)">
                </div>
                <div class="form-group w-1/3 flex items-end gap-3">
                    <input 
                        type="number" 
                        name="variations[{{ $index }}][values][0][in_stock]" 
                        class="input" 
                        placeholder="Készlet">
                    <x-button.chip icon="trash" class="remove-value-row mb-3"/>
                </div>
            </div>
        </div>

    </div>
</div>
