<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCategoryRequest;

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
        $categories = ProductCategory::all();

        return view('admin.categories.form', [
            'category' => null,
            'categories' => $categories
        ]);
    }
    
    /**
     * Store a new category
     */
    public function store(ProductCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        ProductCategory::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created!');
    }

    /**
     * Display category edit form
     */
    public function edit(ProductCategory $category)
    {
        $categories = ProductCategory::where('id', '!=', $category->id)->get();

        return view('admin.categories.form', compact('category', 'categories'));
    }
    
    /**
     * Update a category
     */
    public function update(ProductCategoryRequest $request, ProductCategory $category)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated!');
    }

    /**
     * Delete a category
     */
    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted!');
    }
}