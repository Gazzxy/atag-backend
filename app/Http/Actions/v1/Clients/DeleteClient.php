<?php


namespace App\Http\Actions\v1\Clients;

use App\Models\Client;

class DeleteClient
{
    protected array $response;

    public function execute(int $id): self
    {
        /** @var  $client Client */
        $client = Client::findOrFail($id);

        $this->response = [
            'result' => $client->softDelete()
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
