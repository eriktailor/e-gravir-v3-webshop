<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

use Illuminate\Http\Request;

class WebshopController extends Controller
{
    /**
     * Display shop home page
     */
    public function index()
    {
        $data = [
            'categories' => ProductCategory::all()
        ];

        return view('webshop.index', $data);
    }

    /**
     * Display category archive page
     */
    public function archive($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = $category->products()
                            ->where('hidden', 0)
                            //->where('in_stock', '>', 0)
                            ->orderBy('menu_order')
                            ->paginate(12);

        return view('webshop.archive', compact('products', 'category'));
    }

    /**
     * Display single product page
     */
    public function single($categorySlug, $productSlug)
    {
        // Fetch category (optional)
        $category = ProductCategory::where('slug', $categorySlug)->firstOrFail();

        // Fetch product
        $product = Product::where('slug', $productSlug)
                        ->where('category_id', $category->id) // optional: make sure product belongs to category
                        ->firstOrFail();

        return view('webshop.single', compact('category', 'product'));
    }


    /**
     * Add item to cart
     */
    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
    
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {
            // Get first product image
            $firstImage = $product->images->first();
            $imagePath = $firstImage ? asset('storage/' . $firstImage->image_path) : asset('/img/noimage.webp');
    
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $imagePath,
            ];
        }
    
        session()->put('cart', $cart);
    
        return response()->json([
            'count' => count($cart),
            'message' => 'Termék kosárba rakva!'
        ]);
    }

    /**
     * Remove item from cart
     */
    public function removeFromCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'count' => count($cart),
            'message' => 'Termék eltávolítva a kosárból!',
        ]);
    }

    
    


}
