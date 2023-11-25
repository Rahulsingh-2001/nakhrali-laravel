<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
          'code' => 'required',
          'size' => 'required',
          'status' => 'required|in:1,0',
        ];
    }

    public function messages(): array {
        return [
            'code.required' => 'Please add the size code',
            'size.required' => 'Please add the size measurment',
            'status.required' => 'Please select the status',
            'status.in' => 'Please select the valid status',
        ];
    }
}