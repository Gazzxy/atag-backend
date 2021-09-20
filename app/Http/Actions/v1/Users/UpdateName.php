<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;

class UpdateName
{
    protected array $response;

    public function execute(User $user, string $full_name): self
    {
        $result = $user->update([
            'full_name' => $full_name
        ]);

        $this->response = ['success' => $result];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
