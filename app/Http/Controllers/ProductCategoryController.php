<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.categories.form', [
            'category' => null,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:product_categories,slug',
            'parent_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        ProductCategory::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created!');
    }

    public function edit(ProductCategory $category)
    {
        $categories = ProductCategory::where('id', '!=', $category->id)->get();
        return view('admin.categories.form', compact('category', 'categories'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:product_categories,slug,' . $category->id,
            'parent_id' => 'nullable|exists:product_categories,id',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted!');
    }
}