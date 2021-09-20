<?php

namespace App\Http\Actions\v1\Users;

use App\Models\UserStatus;

class Statuses
{
    protected array $response;

    public function execute(): self
    {
        $this->response = UserStatus::all()->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
