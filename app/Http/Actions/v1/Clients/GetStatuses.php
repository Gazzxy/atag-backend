<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\ClientStatus;

class GetStatuses
{
    protected array $response;

    public function execute(): self
    {
        $this->response = ClientStatus::all(['id', 'title', 'description'])->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
