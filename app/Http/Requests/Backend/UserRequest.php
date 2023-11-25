<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Request;

class UserRequest extends FormRequest
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
        $id = (int)Request::segment(3);

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|unique:users,mobile,' . $id,
            'is_email_verified' => 'sometimes',
            'is_mobile_verified' => 'sometimes',
            'password' => 'required_if:type,ADD',
            'status' => 'required|in:1,0'
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Please enter the first name',
            'last_name.required' => 'Please enter the last name',
            'email.required' => 'Please enter the email',
            'mobile.required' => 'Please enter the mobile number',
            'email.email' => 'Please enter the valid email',
            'password.required' => 'Please enter the password',
            'status.required' => 'Please select the status',
            'status.in' => 'Please select the valid status',
            'email.unique' => 'This email is already taken, try another',
            'mobile.unique' => 'This mobile number is already taken, try another'
        ];
    }
}
