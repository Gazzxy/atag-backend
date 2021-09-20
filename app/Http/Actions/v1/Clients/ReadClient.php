<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\Client;

class ReadClient
{
    protected array $response;

    public function execute(int $id): self
    {
        $result = Client::findOrFail($id);

        $this->response = $result->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
