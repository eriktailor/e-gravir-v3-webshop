<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display products listing
     */
    public function index()
    {
        $products = Product::with('images')->get();

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
        $categories = ProductCategory::all();
        $options = ['Méret', 'Szín', 'Anyag'];

        // Get full URLs of existing images
        $existingImages = $product->images->map(function($img) {
            return [
                'id' => $img->id,
                'url' => asset('storage/' . $img->image_path),
            ];
        });

        return view('admin.products.form', [
            'product' => $product,
            'options' => $options,
            'categories' => $categories,
            'existingImages' => $existingImages
        ]);
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

        // Handle product variations
        if ($request->has('variations')) {        
            foreach ($request->variations as $variation) {
                $product->variations()->create([
                    'name' => $variation['name'],
                    'value' => $variation['value'],
                    'price' => $variation['price'] ?? null,
                    'in_stock' => $variation['in_stock'] ?? 0,
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

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store("products/{$product->id}", 'public');

                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        if ($request->has('variations')) {
            $product->variations()->delete(); // Delete existing variations for update case (optional)
        
            foreach ($request->variations as $variation) {
                $product->variations()->create([
                    'name' => $variation['name'],
                    'value' => $variation['value'],
                    'price' => $variation['price'] ?? null,
                    'in_stock' => $variation['in_stock'] ?? 0,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Adds a product variation item
     */
    public function variationItem(Request $request)
    {
        $index = $request->get('index');
        $options = ['Méret', 'Szín', 'Anyag'];
        
        return view('admin.variations.item', compact('index', 'options'));
    }

    /**
     * Adds a row in product variation item
     */
    public function variationRow(Request $request)
    {
        $variationIndex = $request->get('variationIndex');
        $valueIndex = $request->get('valueIndex');

        return view('admin.variations.row', compact('variationIndex', 'valueIndex'));
    }

}
