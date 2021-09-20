<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\EquipmentView;

class ReadByUUID
{
    protected array $response;

    public function execute(string $uuid): self
    {
        $this->response = EquipmentView::where('public_id', $uuid)->firstOrFail()->toArray();

        $this->response['qr'] = sprintf("%s/equipment-item/%s", request()->getSchemeAndHttpHost(), $this->response['public_id']);

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
