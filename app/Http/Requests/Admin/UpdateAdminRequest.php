<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            "username"=>'required|String|min:3|unique:admins,username,' . $this->id,
            "email"=>'required|email|unique:admins,email,' . $this->id,
            "password"=>'required|String|min:6'
        ];
    }
}
