<?php

namespace App\Http\Requests\API\v1\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfo extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdministrator() || $this->user()->isManagingAccount();
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|max:255',
            'status_id' => 'required',
            'type_id' => 'required',
            'expires_at' => 'nullable|date_format:Y-m-d'
        ];
    }

    public function getFullName()
    {
        return $this->input('full_name');
    }

    public function getStatusID()
    {
        return $this->input('status_id');
    }

    public function getTypeID()
    {
        return $this->input('type_id');
    }

    public function getExpiresAt()
    {
        return $this->input('expires_at', null);
    }
}
