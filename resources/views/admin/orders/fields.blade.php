<!-- Szállítás -->
<x-card title="Szállítás">
    <div class="flex flex-col gap-4">
        <div class="form-group grid grid-cols-3 gap-4">
            @foreach(config('checkout.delivery_methods') as $key => $method)
                <x-form.radio-button 
                    name="delivery_method"
                    :value="$key"
                    :icon="$method['icon']"
                    :label="$method['label']"
                    :info="$method['info']"
                    :price="$method['price']"
                    :checked="old('delivery_method') === $key"
                />
            @endforeach
        </div>
        <div class="form-group hidden" id="foxpostBoxSelect">
            <x-form.select for="delivery_foxpost_box" placeholder="Válassz csomagautómatát"/>
        </div>
        <div id="takeOffAddress" class="py-3 px-4 bg-green-100 text-green-600 hidden">
            Átvétel itt: <strong class="font-semibold">1157 Budapest, Zsókavár utca 22.</strong>
        </div>
        <div class="form-group">
            <x-form.textarea for="delivery_notes" rows="1" placeholder="Megjegyzés a szállításhoz (nem kötelező)"/>
        </div>
    </div>
</x-card>

<!-- Személyes -->
<x-card title="Személyes">
    <div class="flex flex-col gap-4">
        <div class="form-group">
            <x-form.input for="customer_name" placeholder="Teljes név"/>
        </div>
        <div class="form-group">
            <x-form.input for="customer_email" placeholder="Email cím" type="email"/>
        </div>
        <div class="form-group">
            <x-form.input for="customer_phone" placeholder="Telefonszám"/>
        </div>
        <div class="flex gap-4">
            <div class="form-group w-[150px] flex-none">
                <x-form.input for="customer_zip" placeholder="Irányítószám" type="number" min="0"/>
            </div>
            <div class="form-group grow">
                <x-form.input for="customer_city" placeholder="Város"/>
            </div>
        </div>
        <div class="form-group">
            <x-form.input for="customer_address" placeholder="Utca, házszám"/>
        </div>
    </div>
</x-card>

<!-- Fizetés -->
<x-card title="Fizetés">
    <div class="flex flex-col gap-4">
        <div class="form-group grid grid-cols-3 gap-4">
            @foreach(config('checkout.payment_methods') as $key => $method)
                <x-form.radio-button 
                    name="payment_method"
                    :value="$key"
                    :icon="$method['icon']"
                    :label="$method['label']"
                    :info="$method['info']"
                    :checked="old('delivery_method') === $key"
                />
            @endforeach
        </div>
        <div class="form-group">
            <x-form.checkbox for="accept_terms" label="Elfogadom az ÁSZF-ben leírtakat"/>
        </div>
    </div>
</x-card>