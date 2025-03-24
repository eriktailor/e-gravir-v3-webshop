<x-modal title="Státusz" id="changeStatusModal">
    <p>Itt megváltoztathatod a rendelés státuszát.</p>

    <form method="POST" action="" id="orderStatusForm">
        @csrf
        @method('PATCH')

        <div class="form-group mb-4">
            <x-form.select for="status" id="statusSelect">
                @foreach(config('checkout.order_statuses') as $key => $status)
                    <option value="{{ $key }}">
                        {{ $status['label'] }}
                    </option>
                @endforeach
            </x-form.select>
        </div>

        <x-button type="submit">Mentés</x-button>
    </form>    
</x-modal>
