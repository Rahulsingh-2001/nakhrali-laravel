<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'title' => 'required',
            'type_id' => 'required',
            'short_desc' => 'required',
            'sku' => 'required',
            'detail' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'status' => 'required|in:1,0',
            'is_featured' => 'required|in:1,0',
            'is_top_selling' => 'required|in:1,0',
            'discount' => 'digits_between:00,99',
            'minimum_color' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter the title',
            'sku.required' => 'Please enter the title',
            'type_id.required' => 'Please select the type',
            'short_desc.required' => 'Please enter the short description',
            'detail.required' => 'Please enter the description',
            'price.required' => 'Please enter the price',
            'sale_price.required' => 'Please enter the sale price',
            'status.required' => 'Please select the status',
            'status.in' => 'Please select the valid status',
            'discount.digits_between' => 'Please select the valid discount',
            'is_featured.in' => 'Please select the valid action',
            'is_featured.required' => 'Please select the product is featured',
            'is_top_selling.in' => 'Please select the valid action',
            'is_top_selling.required' => 'Please select the product is top selling',
            'minimum_color.required' => 'Please enter the number of minimum color',
        ];
    }
}
