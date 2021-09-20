<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateName extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|max:255'
        ];
    }

    public function getFullName(): string
    {
        return $this->input('full_name');
    }
}
