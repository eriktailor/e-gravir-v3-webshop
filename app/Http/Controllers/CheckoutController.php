<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;

use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Display checkout page
     */
    public function index()
    {
        return view('webshop.checkout');
    }

    /**
     * Store checkout form values in order
     */
    public function store(CheckoutRequest $request)
    {
        dd($request->validated());
        $validated = $request->validated();

        // Add manually the missing fields
        $validated['products_total'] = 0;
        $validated['extra_price'] = 0;
        $validated['delivery_price'] = 0;
        $validated['order_total'] = 0;
        $validated['status'] = 'pending';

        Order::create($validated);

        return redirect()->back()->with('success', 'Megrendelés sikeresen elküldve!');
    }

}
