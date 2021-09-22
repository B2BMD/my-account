<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordRequest extends FormRequest
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
            'profile_password' => 'required|string|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/',
        ];
    }

    public function messages()
    {
        return [
            'profile_password.regex' => 'Password must be minimum six characters, at least one small alphabet , at least one capital alphabet, one number and one special character: ',
            'profile_password.min' => "Password must be minimum six characters.",

        ];
    }
}
