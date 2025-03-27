<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
    
        // save customization
        $cart[$id]['customization'] = [
            'front_text' => $request->input('customizeFrontText'),
            'other_notes' => $request->input('customizeOtherNotes'),
            'engrave_second' => $request->has('engrave_second_page'),
            'back_text' => $request->input('customizeBackText'),
            'engrave_third' => $request->has('engrave_third_page'),
            'inner_text' => $request->input('customizeInnerText'),
            'front_image' => Storage::url($path),
        ];
    
        session()->put('cart', $cart);
    
        return redirect()->route('webshop.checkout')->with('success', 'Testreszabás elmentve!');
    }
    
    


}
