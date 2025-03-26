<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;

use Illuminate\Support\Str;
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
        $id = Str::uuid()->toString();
    
        $cart[$id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $product->images->first()?->image_path,
            'customizations' => [],
        ];
    
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
     * Save product customizations in session
     */
    public function updateCustomization(Request $request)
    {
        $id = $request->input('cart_item_id');
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'A kosár elem nem található.');
        }

        $data = $request->only([
            'front_text',
            'back_text',
            'inner_text',
            'engrave_second_page',
            'engrave_third_page'
        ]);

        // handle optional image uploads
        if ($request->hasFile('front_image')) {
            $data['front_image'] = $request->file('front_image')->store('customizations', 'public');
        }

        if ($request->hasFile('back_image')) {
            $data['back_image'] = $request->file('back_image')->store('customizations', 'public');
        }

        $cart[$id]['customizations'] = $data;
        session()->put('cart', $cart);

        return back()->with('success', 'Testreszabás elmentve!');
    }

    


}
