<?php

namespace App\Http\Requests\API\v1\Clients;

use App\DTO\ClientDTO;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'statusID' => 'required',
            'client_id' => 'required',
            'title' => 'required'
        ];
    }

    public function getClientDTO(int $client_id)
    {
        return new ClientDTO([
            'statusID' => (int)$this->input('statusID'),
            'client_id' => $client_id,
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'address' => $this->input('address'),
            'expires_at' => $this->input('expiresAt'),
            'theme' => $this->input('theme', [])
        ]);
    }
}
