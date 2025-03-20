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

        {{-- Correct wrapper here --}}
        <div>
            <div class="flex gap-6">
                <label class="form-group grow">Érték</label>
                <label class="form-group w-1/3 flex items-end gap-3">Készlet</label>
            </div>
            <div class="variation-values flex flex-col gap-4" data-index="{{ $index }}">

                {{-- Initial row --}}
                @include('admin.variations.row', [
                    'variationIndex' => $index,
                    'valueIndex' => 0
                ])
            </div>
        </div>

    </div>
</div>
