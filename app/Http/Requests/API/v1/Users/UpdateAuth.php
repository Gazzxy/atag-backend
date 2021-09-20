<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuth extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|email',
            'new_password' => 'required|confirmed|min:1|max:255',
        ];
    }

    public function getUsername()
    {
        return $this->input('username');
    }

    public function getNewPassword()
    {
        return $this->input('new_password');
    }
}
