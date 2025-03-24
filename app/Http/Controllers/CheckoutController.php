<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCustomization;

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
    public function store(Request $request)
    {
        Log::info('Checkout STARTED', $request->all());
    
        try {
            $validated = $request->validate([
                'delivery_method' => 'required',
                'customer_name' => 'required|string',
                'customer_email' => 'required|email',
                'customer_phone' => 'required|string',
                'customer_zip' => 'required|string',
                'customer_city' => 'required|string',
                'customer_address' => 'required|string',
                'payment_method' => 'required',
                'accept_terms' => 'accepted',
            ]);
        
            Log::info('Validation PASSED', $validated);
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation FAILED', $e->errors());
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Kérlek javítsd a hibákat, majd küldd be újra az űrlapot.');
        }
    
        if (empty(session('cart'))) {
            Log::error('Cart is EMPTY');
            return back()->with('error', 'A kosarad üres!');
        }
    
        DB::beginTransaction();
    
        try {
            Log::info('Starting order creation...');
    
            // Árak kiszámítása
            $products_total = 0;
            foreach (session('cart') as $item) {
                $products_total += ($item['price'] * $item['quantity']);
            }
            Log::info('Products total:', ['total' => $products_total]);
    
            $delivery_price = config('checkout.delivery_methods')[$validated['delivery_method']]['price'] ?? 0;
            $order_total = $products_total + $delivery_price;
    
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'customer_zip' => $validated['customer_zip'],
                'customer_city' => $validated['customer_city'],
                'customer_address' => $validated['customer_address'],
                'delivery_method' => $validated['delivery_method'],
                'delivery_foxpost_box' => $request->input('delivery_foxpost_box'),
                'delivery_notes' => $request->input('delivery_notes'),
                'payment_method' => $validated['payment_method'],
                'products_total' => $products_total,
                'delivery_price' => $delivery_price,
                'order_total' => $order_total,
                'status' => 'pending',
            ]);
    
            Log::info('Order CREATED', ['order_id' => $order->id]);
    
            // Kosár elemek mentése
            foreach (session('cart') as $id => $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'customizations' => $item['customizations'] ?? null,
                ]);
                Log::info('Order ITEM saved', ['item_id' => $orderItem->id]);
            }
    
            DB::commit();
            Log::info('Transaction COMMITTED, Order Completed!');
    
            session()->forget('cart');
    
            return redirect()->route('webshop.home')->with('success', 'Köszönjük a rendelésed!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout ERROR', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Hiba történt: ' . $e->getMessage());
        }
    }
    
    

}
