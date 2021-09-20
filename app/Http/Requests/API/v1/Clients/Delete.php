<?php

namespace App\Http\Requests\API\v1\Clients;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class Delete extends FormRequest
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
