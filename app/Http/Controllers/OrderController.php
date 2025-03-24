<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display admin orders page
     */
    public function index(Request $request)
    {
        $query = \App\Models\Order::query();

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
}
