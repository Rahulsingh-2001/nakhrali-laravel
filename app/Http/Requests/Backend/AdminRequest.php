<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Request;

class AdminRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'isChangePassword' => 'sometimes',
            'password' => 'required_if:isChangePassword,1',
            'status' => 'required|in:1,0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the name',
            'email.required' => 'Please enter the email',
            'email.email' => 'Please enter the valid email',
            'password.required' => 'Please enter the password',
            'status.required' => 'Please select the status',
            'status.in' => 'Please select the valid status',
            'email.unique' => 'This email is already taken, try another',
        ];
    }
}