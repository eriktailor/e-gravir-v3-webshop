<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    /**
     * Display categories listing
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Display category create form
     */
    public function create()
    {
        return view('admin.categories.form', [
            'category' => null
        ]);
    }

    /**
     * Store a new category
     */
    public function store(ProductCategoryRequest $request)
    {
        $data = $request->validated();

        // 1️⃣ Create category without image
        $category = ProductCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
        ]);

        // 2️⃣ Save image after
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store("categories/{$category->id}", 'public');
            $category->update(['image' => $imagePath]);
        }

        return redirect()->route('categories.index')->with('success', 'Category created!');
    }

    /**
     * Display category edit form
     */
    public function edit(ProductCategory $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update a category
     */
    public function update(ProductCategoryRequest $request, ProductCategory $category)
    {
        $data = $request->validated();

        // Update fields
        $category->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'] ?? null,
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            // Save new image
            $imagePath = $request->file('image')->store("categories/{$category->id}", 'public');
            $category->update(['image' => $imagePath]);
        } else {
            // If image removed, delete old image + set null
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $category->update(['image' => null]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    /**
     * Delete a category
     */
    public function destroy(ProductCategory $category)
    {
        // Delete image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete folder if empty
        Storage::disk('public')->deleteDirectory("categories/{$category->id}");

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted!');
    }
}
