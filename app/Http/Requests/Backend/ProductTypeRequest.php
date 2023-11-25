<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductTypeRequest extends FormRequest
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
           'status' => 'required|in:1,0'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter the title',
            'status.required' => 'Please select the status',
            'status.in' => 'Please select the valid status'
        ];
    }
}
