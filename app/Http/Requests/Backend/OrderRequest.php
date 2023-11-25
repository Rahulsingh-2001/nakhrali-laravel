<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'amount' => 'required|numeric',
            'payment_type' => 'required|in:ONLINE,COD',
            'transaction_id' => 'nullable',
            'payment_status' => 'required',
            'tracking_id' => 'nullable',
            'tracking_status' => 'nullable',
            'status' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Please select a user',
            'amount.required' => 'Please fill the amount',
            'payment_type.required' => 'Please select a payment type',
            'payment_status.required' => 'Please select a payment status',
            'status.required' => 'Please select a order request',
        ];
    }
}
