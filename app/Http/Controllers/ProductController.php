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
    
        // Handle checkboxes
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;

        // Create product
        $product = Product::create($data);
    
        // Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store("products/{$product->id}", 'public');
    
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
    
        // Variations
        if ($request->has('variations')) {
            foreach ($request->input('variations') as $variation) {
                if (empty($variation['name'])) continue;
                if (isset($variation['values']) && is_array($variation['values'])) {
                    foreach ($variation['values'] as $valueRow) {
                        if (empty($valueRow['value'])) continue;
        
                        $product->variations()->create([
                            'name' => $variation['name'],
                            'value' => $valueRow['value'],
                            'price' => 0,
                            'in_stock' => $valueRow['in_stock'] ?? 0,
                        ]);
                    }
                }
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
    
        // Checkboxes
        $data['is_visible'] = $request->has('is_visible') ? 1 : 0;
        $data['featured'] = $request->has('featured') ? 1 : 0;
    
        $product->update($data);
    
        // Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store("products/{$product->id}", 'public');
    
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        
        // Variations
        $product->variations()->delete();
        if ($request->has('variations')) {
            foreach ($request->input('variations') as $variation) {
                if (empty($variation['name'])) continue;
                if (isset($variation['values']) && is_array($variation['values'])) {
                    foreach ($variation['values'] as $valueRow) {
                        if (empty($valueRow['value'])) continue;
        
                        $product->variations()->create([
                            'name' => $variation['name'],
                            'value' => $valueRow['value'],
                            'price' => 0,
                            'in_stock' => $valueRow['in_stock'] ?? 0,
                        ]);
                    }
                }
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
