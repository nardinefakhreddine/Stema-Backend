<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            "username"=>'required|String|min:3|unique:users,username,' . $this->id,
            "phone"=>'required|String|min:6|unique:users,phone,' . $this->id,
            "email"=>'required|email|unique:users,email,' . $this->id,
            "password"=>'required|String|min:6'
        ];
    }
}
