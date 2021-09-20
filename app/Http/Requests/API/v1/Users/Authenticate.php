<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class Authenticate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|max:255',
            'password' => 'required|max:255',
        ];
    }

    public function username(): string
    {
        return strtolower($this->input('username'));
    }

    public function password(): string
    {
        return $this->input('password');
    }
}
