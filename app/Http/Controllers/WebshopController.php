<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use RahulHaque\Filepond\Facades\Filepond;

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
        $category = ProductCategory::where('slug', $categorySlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)->where('category_id', $category->id)->firstOrFail();
        $images = ProductImage::where('product_id', $product->id)->get();

        return view('webshop.single', compact('category', 'product', 'images'));
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

    /**
     * Customize products in cart
     */
    public function customizeCartItem(Request $request, $id)
    {
        $cart = session()->get('cart', []);
    
        if (!isset($cart[$id])) {
            return response()->json(['error' => 'Nincs ilyen termék a kosárban'], 404);
        }
    
        // handle FilePond image
        $file = Filepond::field($request->front_image)->moveTo('customizations');
        $imagePath = $file['location'] ?? null;
    
        // save customization
        $cart[$id]['customization'] = [
            'front_text' => $request->input('customizeFrontText'),
            'other_notes' => $request->input('customizeOtherNotes'),
            'engrave_second' => $request->has('engrave_second_page'),
            'back_text' => $request->input('customizeBackText'),
            'engrave_third' => $request->has('engrave_third_page'),
            'inner_text' => $request->input('customizeInnerText'),
            'front_image' => $imagePath,
        ];
    
        session()->put('cart', $cart);
    
        return response()->json(['success' => 'Testreszabás elmentve!']);
    }
    
    


}
