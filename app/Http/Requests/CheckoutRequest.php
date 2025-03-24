<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow anyone to submit
    }

    public function rules(): array
    {
        return [
            // Personal Info
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'required|string|max:50',
            'customer_zip'      => 'required',
            'customer_city'     => 'required|string|max:100',
            'customer_address'  => 'required|string|max:255',

            // Delivery
            'delivery_method'   => 'required|in:' . implode(',', array_keys(config('checkout.delivery_methods'))),
            'delivery_foxpost_box' => 'nullable|string|max:255',
            'delivery_notes'    => 'nullable|string|max:1000',

            // Payment
            'payment_method'    => 'required|in:' . implode(',', array_keys(config('checkout.payment_methods'))),
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Kérlek, add meg a neved!',
            'customer_email.required' => 'Kérlek, add meg az email címed!',
            'customer_phone.required' => 'Kérlek, add meg a telefonszámod!',
            'customer_zip.required' => 'Kérlek, add meg az irányítószámot!',
            'customer_city.required' => 'Kérlek, add meg a várost!',
            'customer_address.required' => 'Kérlek, add meg a címet!',
            'delivery_method.required' => 'Válassz szállítási módot!',
            'payment_method.required' => 'Válassz fizetési módot!',
        ];
    }
}
