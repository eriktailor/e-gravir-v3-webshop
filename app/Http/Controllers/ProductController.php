<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display products listing
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Admin: create product
     */
    public function create() 
    {
        $categories = ProductCategory::all();

        return view('admin.products.form', [
            'product' => null,
            'categories' => $categories
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

        // Handle checkboxes (default to 0 if not checked)
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;

        // 1. Create product
        $product = Product::create($data);

        // 2. Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store("products/{$product->id}", 'public');

                // 3. Save image record
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

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

        // Update product
        $product->update($data);

        // ===== Handle Images ===== //

        if ($request->hasFile('images')) {

            // 1. Delete old images (both file + DB)
            foreach ($product->images as $img) {
                \Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }

            // 2. Save new images
            foreach ($request->file('images') as $image) {
                $path = $image->store("products/{$product->id}", 'public');

                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

}
