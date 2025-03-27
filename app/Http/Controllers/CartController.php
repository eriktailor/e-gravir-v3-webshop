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
        $product->load('images');
        $cart = session('cart', []);
        $cartItemId = uniqid();
        
        $cart[$cartItemId] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->firstImageUrl(),
            'extra_price' => 0,
            'quantity' => 1,
        ];
    
        session(['cart' => $cart]);
    
        return back()->with('success', 'Termék a kosárba került!');
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartItemId = $request->cart_item_id;
    
        unset($cart[$cartItemId]);
        session()->put('cart', $cart);
    
        return response()->json(['success' => 'Termék eltávolítva a kosárból!']);
    }

    /**
     * Store cart customizations
     */
    public function storeCustomizations(Request $request)
    {
        $all = [];
    
        foreach ($request->input('customizations', []) as $cartItemId => $fields) {
            $frontImage = $request->file("customizations.$cartItemId.front_image");
            $backImage = $request->file("customizations.$cartItemId.back_image");
    
            if ($frontImage) {
                $path = $frontImage->store("customizations/$cartItemId", 'public');
                $fields['front_image'] = $path;
            }
    
            if ($backImage) {
                $path = $backImage->store("customizations/$cartItemId", 'public');
                $fields['back_image'] = $path;
            }
    
            $all[$cartItemId] = $fields;
        }
        
        session(['cart_customizations' => $all]);

        return redirect()->route('webshop.checkout');
    }

    
}
