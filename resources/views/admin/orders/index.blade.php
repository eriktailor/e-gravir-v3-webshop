@extends('layouts.admin')

@section('title', 'Rendelések')

@section('content')

    <x-header.page :title="'Rendelések'">
        <x-slot name="button">
            <x-button href="#">Export Foxpost Csv</x-button>
        </x-slot>
    </x-header.page>

    <div class="container">
        <div class="mb-6">
            <x-form.input for="order_search" placeholder="Keresés név, email, telefon, ID alapján..."/>
        </div>
        <div id="ordersList">
            @include('admin.orders.list', ['orders' => $orders])
        </div>
    </div>

    @include('admin.orders.status')

@endsection

@push('scripts')
    <script>
        $('#order_search').on('input', function() {
            let query = $(this).val();

            $.ajax({
                url: '{{ route("orders.index") }}',
                type: 'GET',
                data: { search: query },
                success: function(response) {
                    $('#ordersList').html(response);
                }
            });
        });

        $('.change-status-btn').on('click', function() {
            let orderId = $(this).data('id');
            let status = $(this).data('status');

            // Set form action
            $('#orderStatusForm').attr('action', `/admin/orders/${orderId}/status`);

            // Set select value
            $('#statusSelect').val(status);
        });
    </script>
@endpush