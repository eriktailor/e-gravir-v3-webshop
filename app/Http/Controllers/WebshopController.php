<?php

namespace App\Http\Controllers;

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

}
