<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Admin: create product
     */
    public function create() {
        return view('admin.products.form', [
            'product' => null
        ]);
    }

    /**
     * Admin: edit product
     */
    public function edit(Product $product) {
        return view('admin.products.form', compact('product'));
    }

    /**
     * Store a new product
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // Handle checkboxes (unchecked not sent)
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
        dd($data);
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Update an existing product
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        // Handle checkboxes
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}
