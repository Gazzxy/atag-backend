<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class RetrievePassword extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255'
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }
}
