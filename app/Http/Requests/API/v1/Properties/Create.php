<?php

namespace App\Http\Requests\API\v1\Properties;

use App\DTO\PropertyDTO;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdministrator();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'address' => 'required',
            'city' => 'required',
            'postcode' => 'required'
        ];
    }

    public function getDataModel(): PropertyDTO
    {
        return new PropertyDTO([
            'client_id' => $this->input('client_id'),
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'address_formatted' => $this->input('address'),
            'postcode' => $this->input('postcode'),
            'city' => $this->input('city'),
        ]);
    }
}
