<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
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
            'product_id' => 'required',
            'size_id' => 'required',
            'color_id' => 'required',
            'status' => 'required',
            'total_pc' => 'required',
            'available_pc' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Please enter the product id',
            'size_id.required' => 'Please select the size',
            'color_id.required' => 'Please the select the color',
            'status.required' => 'Please the select the status',
            'total_pc.required' => 'Please enter the total number of product',
            'available_pc.required' => 'Please enter the total available number of product',
        ];
    }
}
