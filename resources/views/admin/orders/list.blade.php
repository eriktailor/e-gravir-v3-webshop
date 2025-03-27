<div class="orders-list flex flex-col">
    @forelse($orders as $order)
        <x-card padding="p-8" class="flex items-center justify-between">
            <div class="grid grid-cols-12 items-center w-full">
                <div class="flex items-center">
                    <x-form.checkbox for="select_order[' . $order->id .']"/>
                    <x-badge>#{{ $order->id }}</x-badge>
                </div>
                <div class="flex items-center justify-center">
                    @foreach($order->items->take(1) as $item)
                        <img 
                            src="/storage/{{ $item['customizations']['front_image'] }}" 
                            alt="#{{ $order->id }} rendelés kép"
                            class="w-14 h-14 object-cover object-center rounded-full -mr-4 border-3 border-white mr-3">
                    @endforeach
                </div>
                <div class="col-span-3">
                    <x-heading level="h4" class="mb-1">{{ $order->customer_name }}</x-heading>
                    <p class="text-gray-400 text-sm">{{ $order->customer_email }}</p>
                </div>
                <div class="col-span-2">
                    <div class="font-medium text-red-600 mb-1">{{ $order->order_total }} Ft</div>
                    <div class="text-sm text-gray-400">{{ $order->items->count() }} termék</div>
                </div>
                <div class="col-span-2 flex items-center gap-x-8">
                    <div>
                        @php
                            $delivery_icon = config('checkout.delivery_methods')[$order->delivery_method]['icon'] ?? 'package';
                            $delivery_label = config('checkout.delivery_methods')[$order->delivery_method]['label'] ?? 'Szállítás';
                        @endphp
                        <x-tooltip text="{{ $delivery_label }}">
                            <x-icon name="{{ $delivery_icon }}" class="text-gray-400 w-7 h-7"/>
                        </x-tooltip>
                    </div>
                    <div>
                        @php
                            $payment_icon = config('checkout.payment_methods')[$order->payment_method]['icon'] ?? 'coins';
                            $payment_label = config('checkout.payment_methods')[$order->payment_method]['label'] ?? 'Fizetés';
                        @endphp
                        <x-tooltip text="{{ $payment_label }}">
                            <x-icon name="{{ $payment_icon }}" class="text-gray-400 w-7 h-7"/>
                        </x-tooltip>
                    </div>
                </div>
                <div class="col-span-2 text-right">
                    @php
                        $order_status = config('checkout.order_statuses')[$order->status] ?? [
                            'label' => ucfirst($order->status),
                            'color' => 'default',
                        ];
                    @endphp
                    <a href="#changeStatusModal" 
                        class="modal-toggle change-status-btn" 
                        data-id="{{ $order->id }}" 
                        data-status="{{ $order->status }}">
                        <x-badge color="{{ $order_status['color'] }}">
                            {{ $order_status['label'] }}
                        </x-badge>
                    </a>
                </div>
                <div class="flex items-center gap-x-3 justify-between">
                    <x-icon name="{{ $order->invoice_number ? 'circle-check-filled' : 'circle-check' }}" 
                            class="ml-6 {{ $order->invoice_number ? 'fill-green-600 text-white' : 'text-gray-400' }}"/>
                    <x-button.chip icon="chevron-right" href="{{ route('orders.show', $order->id) }}"/>
                </div>
            </div>
        </x-card>
    @empty
        <p>Nincs Rendelés</p>
    @endforelse
</div>