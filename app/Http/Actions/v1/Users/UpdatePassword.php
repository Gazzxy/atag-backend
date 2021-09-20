<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;

class UpdatePassword
{
    protected array $response;

    public function execute(User $user, string $password)
    {
        $result = $user->updatePassword($password);

        $this->response = ['result' => $result];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
