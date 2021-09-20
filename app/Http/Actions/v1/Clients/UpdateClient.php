<?php

namespace App\Http\Actions\v1\Clients;

use App\DTO\ClientDTO;
use App\Models\Client;

class UpdateClient
{
    protected array $response;

    public function execute(ClientDTO $dto): self
    {
        $model = Client::findOrFail($dto->client_id);

        $result = $model->update($dto->toArray());

        $this->response = ['result' => $result];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
