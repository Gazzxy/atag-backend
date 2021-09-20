<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentView;

class Read
{
    protected array $response;

    public function execute(int $id): self
    {
        $this->response = EquipmentView::findOrFail($id)->toArray();

        $this->response['qr'] = sprintf("%s/equipment-item/%s", request()->getSchemeAndHttpHost(), $this->response['public_id']);

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
