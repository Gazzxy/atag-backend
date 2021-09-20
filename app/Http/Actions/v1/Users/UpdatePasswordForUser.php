<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;

class UpdatePasswordForUser
{
    protected array $response;

    public function execute(int $user_id, string $password): self
    {
        /** @var  $user User */
        $user = User::findOrFail($user_id);

        $user->setRequirePasswordChange(false);

        $this->response = ['result' => $user->updatePassword($password)];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
