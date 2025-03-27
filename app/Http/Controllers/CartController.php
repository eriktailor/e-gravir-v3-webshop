<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCustomization;

class CartController extends Controller
{
    /**
     * Display cart (customize) page
     */
    public function index()
    {
        $cart = session('cart', []);
        $productIds = collect($cart)->pluck('product_id')->unique();
        $customizations = ProductCustomization::whereIn('product_id', $productIds)->get()->keyBy('product_id');
        
        return view('webshop.cart', compact('cart', 'customizations'));
    }

    /**
     * Add item to cart
     */
    public function addToCart(Request $request, Product $product)
    {
        $cart = session('cart', []);
        
        $cartItemId = uniqid();
    
        $cart[$cartItemId] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image_url,
            'quantity' => 1,
        ];
    
        session(['cart' => $cart]);
    
        return back()->with('success', 'Termék a kosárba került!');
    }
    
}
