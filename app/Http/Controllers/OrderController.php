<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display admin orders listing
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                ->orWhere('customer_email', 'like', "%{$search}%")
                ->orWhere('customer_phone', 'like', "%{$search}%")
                ->orWhere('id', $search);
            });
        }

        $orders = $query->with('items')->latest()->get();

        if ($request->ajax()) {
            return view('admin.orders.list', compact('orders'))->render();
        }

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display order single page
     */
    public function show(Order $order)
    {
        $order->load(['items.product.images', 'customizations']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function status(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(config('checkout.order_statuses')))],
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->back()->with('success', 'Rendelés státusza frissítve!');
    }
}
