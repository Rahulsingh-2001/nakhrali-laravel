<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'add_1' => 'required',
            'add_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'note' => 'nullable',
            'pincode' => 'required',
            'payment_type' => 'required|in:COD,ONLINE'
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Please enter first name',
            'last_name.required' => 'Please enter last name',
            'email.required' => 'Please enter your email address',
            'email.email' => 'Please enter the valid email address',
            'add_1.required' => 'Please enter your address',
            'add_2.required' => 'Please enter your address',
            'city.required' => 'Please enter your city name',
            'state.required' => 'Please enter your state name',
            'phone.required' => 'Please enter your contact no',
            'pincode.required' => 'Please enter your pincode',
            'payment_type.required' => 'Please select the payment mode',
            'payment_type.in' => 'Please select the valid payment mode'
        ];
    }
}
