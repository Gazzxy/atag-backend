<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\Equipment;

class DeleteEquipment
{
    protected array $response;

    public function execute(int $id): self
    {
        $equipment = Equipment::findOrFail($id);

        $this->response = [
            'result' => $equipment->softDelete()
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
