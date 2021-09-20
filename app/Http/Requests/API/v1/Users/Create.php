<?php

namespace App\Http\Requests\API\v1\Users;

use App\DTO\UserDTO;
use App\Models\UserStatus;
use Illuminate\Support\Str;
use App\Models\ClientAccountType;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'name' => 'required|min:1|max:255',
            'password' => 'required_if:config.autoGeneratePassword,false',
            'client_id' => 'required'
        ];
    }

    public function getUserDTO(): UserDTO
    {
        $autogenerate = (bool)$this->input('config.autoGeneratePassword', false);

        $password = $autogenerate ? Str::random(10) : $this->input('password');

        $require_mail_confirmation = (bool)$this->input('config.requireEmailConfirmation', false);

        $status_id = $require_mail_confirmation ? UserStatus::S_PENDING : UserStatus::S_ACTIVE;

        return new UserDTO([
            'email' => $this->input('email'),
            'name' => $this->input('name'),
            'password' => $password,
            'hashed_password' => password_hash($password, PASSWORD_ARGON2I),
            'client_id' => (int)$this->input('client_id'),
            'type_id' => ClientAccountType::T_USER_ACCOUNT,
            'status_id' => $status_id,
            'autoGeneratePassword' => (bool)$this->input('config.autoGeneratePassword', false),
            'requireEmailConfirmation' => (bool)$this->input('config.requireEmailConfirmation', false),
            'requirePasswordChangeOnFirstLogin' => (bool)$this->input('config.requirePasswordChangeOnFirstLogin', false),
            'sendNotificationEmail' => (bool)$this->input('config.sendNotificationEmail', false),
        ]);
    }
}
