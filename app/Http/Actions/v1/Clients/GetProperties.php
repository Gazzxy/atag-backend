<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\PropertyView;

class GetProperties
{
    protected array $response;

    public function execute(int $client_id): self
    {
        $properties = PropertyView::where('client_id', $client_id)
            ->where('deleted', 0)
            ->orderBy('id', 'ASC')
            ->get();

        $this->response = $properties->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
