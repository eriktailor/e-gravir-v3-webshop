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
        $validated = $request->validated();

        Order::create($validated);

        return redirect()->back()->with('success', 'Megrendelés sikeresen elküldve.');
    }
}
