<?php

namespace App\Http\Requests\API\v1\Properties;

use Illuminate\Foundation\Http\FormRequest;

class Write extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdministrator();
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
