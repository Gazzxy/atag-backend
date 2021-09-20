<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class Write extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
