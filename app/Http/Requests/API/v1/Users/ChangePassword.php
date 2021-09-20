<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:5|max:255',
        ];
    }

    public function getPassword(): string
    {
        return $this->input('password');
    }

    public function getResetPayload(): string
    {
        return $this->input('payload', '');
    }
}
