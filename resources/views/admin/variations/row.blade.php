<div class="flex gap-4 variation-value-row">
    <div class="form-group grow">
        <x-form.input 
            type="text" 
            for="variations[{{ $variationIndex }}][values][{{ $valueIndex }}][value]" 
            class="input variation-value-input" 
            placeholder="pl. Közepes"/>
    </div>
    <div class="form-group w-1/3 flex items-end gap-3">
        <x-form.input 
            type="number" 
            for="variations[{{ $variationIndex }}][values][{{ $valueIndex }}][in_stock]" 
            class="input" 
            placeholder="0 db"/>
        <x-button.chip icon="trash" class="remove-value-row mb-3" tabindex="-1"/>
    </div>
</div>