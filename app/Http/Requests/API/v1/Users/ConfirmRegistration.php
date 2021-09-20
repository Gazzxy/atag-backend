<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmRegistration extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slug' => 'required',
            'password' => 'required|min:3|max:255'
        ];
    }

    public function getSlug(): string
    {
        return $this->input('slug');
    }

    public function getUserPassword(): string
    {
        return $this->input('password');
    }
}
