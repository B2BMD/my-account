<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sign_up_name' => 'required|string|max:255|regex: /^([a-z A-Z]+)$/',
            'sign_up_email' => 'required|string|email|unique:users,email',
            'sign_up_password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/',
            'checkbox' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sign_up_name.string' => "Name must be string",
            'sign_up_name.required' => "Name must be required",
            'sign_up_name.regex' => "Name must conatin alphabets and white spaces only",
            'sign_up_email.required' => "Email must be required",
            'sign_up_email.email' => "Please enter valid email",
            'sign_up_password.regex' => 'Password must be minimum six characters, at least one small alphabet , at least one capital alphabet, one number and one special character: ',
            'sign_up_password.min' => "Password must be minimum six characters.",
            'checkbox.required' => 'Please select Terms of Service and Privacy Policy'

        ];
    }
}
