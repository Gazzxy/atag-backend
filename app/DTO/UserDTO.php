<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class UserDTO extends ManagingAccountDTO
{
    public int $status_id;

    public function toArray()
    {
        return [
            'is_administrator' => 0,
            'status_id' => $this->status_id,
            'type_id' => $this->type_id,
            'client_id' => $this->client_id,
            'full_name' => $this->name,
            'email' => $this->email,
            'password' => $this->hashed_password,
            'config' => [
                'autoGeneratePassword' => $this->autoGeneratePassword,
                'requireEmailConfirmation' => $this->requireEmailConfirmation,
                'requirePasswordChangeOnFirstLogin' => $this->requirePasswordChangeOnFirstLogin,
                'sendNotificationEmail' => $this->sendNotificationEmail,
            ]
        ];
    }
}
