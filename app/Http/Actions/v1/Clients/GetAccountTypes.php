<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\ClientAccountType;

class GetAccountTypes
{
    protected array $response;

    public function execute(): self
    {
        $this->response = ClientAccountType::all(['id', 'title', 'description', 'config'])->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
