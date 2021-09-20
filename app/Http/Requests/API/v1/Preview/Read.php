<?php

namespace App\Http\Requests\API\v1\Preview;

use Illuminate\Foundation\Http\FormRequest;

class Read extends FormRequest
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
