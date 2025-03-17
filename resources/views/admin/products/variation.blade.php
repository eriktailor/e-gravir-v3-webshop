<div class="variation-item flex flex-col gap-4 border border-gray-300 p-6 rounded-lg mb-3">
    <div class="edit-variation flex flex-col gap-4">
        <div class="form-group">
            <x-form.input 
                for="variations[__INDEX__][name]" 
                value="" 
                label="Megnevezés" 
                placeholder="Típus (pl. Méret)" 
                type="text"/>
        </div>
        <div class="form-group">
            <x-form.input 
                for="variations[__INDEX__][value]" 
                value=""
                label="Érték" 
                placeholder="Érték (pl. M)" 
                type="text"/>
        </div>
    </div>
</div>