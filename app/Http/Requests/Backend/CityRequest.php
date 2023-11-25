<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required',
            'state_id' => 'required',
            'status' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the city name',
            'state_id.required' => 'Please select the state',
            'status.required' => 'Please select the status',
        ];
    }
}