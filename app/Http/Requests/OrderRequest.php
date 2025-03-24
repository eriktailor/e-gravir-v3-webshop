<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'delivery_method' => 'required',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_zip' => 'required|numeric|min:1000|max:9999',
            'customer_city' => 'required|string',
            'customer_address' => 'required|string',
            'payment_method' => 'required',
            'accept_terms' => 'accepted',
        ];
    }

    /**
     * Custom validation error messages
     */
    public function messages()
    {
        return [
            '*.required' => 'Ez a mező kötelező.',
            'accept_terms.accepted' => 'El kell fogadnod az ÁSZF-et.',
        ];
    }

    /**
     * Display custom error message in topbar
     */
    public function failedValidation(Validator $validator)
    {
        session()->flash('error', 'Hibás űrlap! Kérlek javítsd a hibákat, majd küldd be újra az űrlapot.');

        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }

}
