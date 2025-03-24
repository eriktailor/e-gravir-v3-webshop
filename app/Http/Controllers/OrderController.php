<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display admin orders page
     */
    public function index()
    {
        $orders = Order::paginate(20);

        return view('admin.orders.index', compact('orders'));
    }
}
