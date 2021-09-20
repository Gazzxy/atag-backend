<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;

class Delete
{
    protected array $response;

    public function execute(int $user_id): self
    {
        /** @var  $user User */
        $user = User::findOrFail($user_id);

        $this->response = [
            'result' => $user->softDelete()
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
