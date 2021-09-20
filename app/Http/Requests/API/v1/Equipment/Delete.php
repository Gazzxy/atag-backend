<?php

namespace App\Http\Requests\API\v1\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class Delete extends FormRequest
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
