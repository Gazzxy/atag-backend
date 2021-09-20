<?php

namespace App\Http\Requests\API\v1\Permissions;

use Illuminate\Foundation\Http\FormRequest;

class Read extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
