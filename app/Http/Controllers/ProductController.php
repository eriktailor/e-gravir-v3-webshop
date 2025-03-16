<?php

namespace App\Http\Controllers;

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

    public function store(ProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}
