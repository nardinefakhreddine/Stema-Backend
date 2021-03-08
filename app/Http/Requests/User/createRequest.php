<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class createRequest extends FormRequest
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
            'name'=>'required|String|min:3',
            "username"=>'required|String|min:3',
            "phone"=>'required|String|min:6',
            "email"=>'required|email',
            "password"=>'required|String|min:6'
        ];
    }
}
