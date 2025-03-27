<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCustomization;

use App\Http\Requests\OrderRequest;

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
    public function store(OrderRequest $request)
    {
        if (empty(session('cart'))) {
            Log::error('Cart is EMPTY');
            return back()->with('error', 'A kosarad üres!');
        }

        DB::beginTransaction();

        try {
            $validated = $request->validated();
            
            $products_total = 0;
            foreach (session('cart') as $item) {
                $products_total += $item['price'];
            }

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

            // OrderItems
            foreach (session('cart') as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'] ?? null,
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'customizations' => $item['customization'] ?? null,
                ]);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('webshop.home')->with('success', 'Köszönjük a rendelésed!');
        
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout ERROR', ['message' => $e->getMessage()]);
        
            return back()
                ->withInput()
                ->with('error', 'Hiba történt: ' . $e->getMessage());
        }
    }
    
    

}
