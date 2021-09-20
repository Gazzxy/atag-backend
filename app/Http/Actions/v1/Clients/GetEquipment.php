<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\EquipmentView;

class GetEquipment
{
    protected array $response;

    public function execute(int $client_id): self
    {
        $result = EquipmentView::where('client_id', $client_id)
            ->where('deleted', 0)
            ->orderBy('property_id', 'desc')
            ->get();

        $this->response = $result->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
