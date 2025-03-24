@extends('layouts.admin')

@section('title', isset($order) ? 'Rendelés szerkesztése' : 'Új rendelés')

@section('content')

<x-header.page :title="isset($order) ? 'Rendelés szerkesztése' : 'Új rendelés'"/>

<div class="container">
    <form action="{{ isset($order) ? route('orders.update', $order) : route('orders.store') }}" id="orderForm" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @if(isset($order))
            @method('PUT')
        @endif

        <div class="grid grid-cols-2 gap-6">

            @include('admin.orders.fields')
        
        </div>

    </form>
</div>

@endsection

@push('scripts')
    <script>
        $('.delete-category-btn').on('click', function(e) {
            if(confirm('Biztosan törölni szeretnéd?')) {
                let url = $(this).data('url');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Redirect or show message
                        window.location.href = "{{ route('categories.index') }}";
                    },
                    error: function(err) {
                        alert('Hiba történt!');
                    }
                });
            }
        });
    </script>
@endpush