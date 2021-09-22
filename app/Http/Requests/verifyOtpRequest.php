<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class verifyOtpRequest extends FormRequest
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
            'otp' => 'required|min:4|max:4|integer',
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'Otp must br required',
            'otp.min' => 'Otp must have minimum 4 digits',
            'otp.max' => 'Otp must have maximum 4 digits',


        ];
    }
}
