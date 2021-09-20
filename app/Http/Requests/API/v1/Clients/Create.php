<?php

namespace App\Http\Requests\API\v1\Clients;

use App\DTO\ClientDTO;
use App\Models\Client;
use App\DTO\ManagingAccountDTO;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('writeAccess', Client::class);
    }

    public function rules(): array
    {
        return [
            'client.statusID' => 'required|int',
            'client.title' => 'required|min:1|max:255',
            'client.description' => 'sometimes|max:255',
            'client.address' => 'sometimes|max:255',
            'client.expiresAt' => 'nullable|date_format:Y-m-d',
            'account.email' => 'required|email|max:255',
            'account.name' => 'required|min:1|max:255',
            'account.password' => 'required_if:account.config.autoGeneratePassword,false'
        ];
    }

    public function getClientDTO(): ClientDTO
    {
        return new ClientDTO([
            'statusID' => (int)$this->input('client.statusID'),
            'title' => $this->input('client.title'),
            'description' => $this->input('client.description'),
            'address' => $this->input('client.address'),
            'expires_at' => $this->input('client.expiresAt')
        ]);
    }

    public function getManagingAccountDTO(): ManagingAccountDTO
    {
        return new ManagingAccountDTO([
            'email' => $this->input('account.email'),
            'name' => $this->input('account.name'),
            'password' => $this->input('account.password'),
            'requireEmailConfirmation' => (bool)$this->input('account.config.requireEmailConfirmation'),
            'autoGeneratePassword' => (bool)$this->input('account.config.autoGeneratePassword'),
            'requirePasswordChangeOnFirstLogin' => (bool)$this->input('account.config.requirePasswordChangeOnFirstLogin'),
            'sendNotificationEmail' => (bool)$this->input('account.config.sendNotificationEmail')
        ]);
    }
}
