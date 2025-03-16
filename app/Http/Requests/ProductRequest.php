<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'tags' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'in_stock' => 'required|integer|min:0',
            'menu_order' => 'nullable|integer',
            'is_visible' => 'nullable|boolean', // nullable to avoid "required" error when unchecked
            'featured' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
