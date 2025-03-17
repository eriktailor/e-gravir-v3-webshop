<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules
     */
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
            'category_id' => 'required|exists:product_categories,id',
            'tags' => ['nullable', 'string', 'regex:/^([a-zA-Z0-9áéíóöőúüűÁÉÍÓÖŐÚÜŰ\s\-]+,?\s*)*$/'],
            'variations' => 'nullable|array',
            'variations.*.name' => 'nullable|string',
            'variations.*.values' => 'nullable|array',
            'variations.*.values.*.value' => 'nullable|string',
            'variations.*.values.*.in_stock' => 'nullable|integer',
        ];
    }

    /**
     * Tags (comma separated values) validation
     */
    protected function prepareForValidation()
    {
        if ($this->tags) {
            $tags = explode(',', $this->tags);
            $tags = array_map(fn($tag) => trim($tag), $tags);
            $tags = array_filter($tags);
            $this->merge([
                'tags' => implode(',', $tags),
            ]);
        }
    }

}
