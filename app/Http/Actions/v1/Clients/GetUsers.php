<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\UsersView;

class GetUsers
{
    protected array $response;

    public function execute(int $client_id): self
    {
        $result = UsersView::where('client_id', $client_id)
            ->where('deleted', 0)
            ->orderBy('id', 'DESC')
            ->get();

        $this->response = $result->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
