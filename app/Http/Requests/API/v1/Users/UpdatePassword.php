<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'new_password' => 'required|max:255|confirmed',
        ];
    }

    public function getNewPassword(): string
    {
        return $this->input('new_password');
    }
}
