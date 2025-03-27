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


    
    


}
