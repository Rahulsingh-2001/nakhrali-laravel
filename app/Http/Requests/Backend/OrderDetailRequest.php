<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => 'required',
            'product_id' => 'required',
            'variant_id' => 'required',
            'quantity' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'order_id.required' => 'Something went wrong',
            'product_id.required' => 'Please select a product',
            'variant_id.required' => 'Please select a variant',
            'quantity.required' => 'Please add a quantity'
        ];
    }
}
