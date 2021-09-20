<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;

class Info
{
    protected array $response;

    public function execute(User $user): self
    {
        $this->response = [
            'email' => $user->getEmail(),
            'full_name' => $user->getFullName(),
            'client_id' => $user->getClientID(),
            'client_name' => $user->getClientName(),
            'avatar' => $user->getAvatar(),
            'admin' => $user->isAdministrator(),
            'managing_account' => $user->isManagingAccount(),
            'user_account' => $user->isUserAccount(),
            'permissions' => [
                'client:read' => $user->hasPermission('client:read'),
            ]
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
