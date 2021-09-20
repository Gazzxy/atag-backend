<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\Equipment;
use App\DTO\Equipment as EquipmentDTO;

class Create
{
    private array $response;

    public function execute(EquipmentDTO $data): self
    {
        /** @var  $model Equipment */
        $model = Equipment::create($data->toArray());

        $this->response = $model->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
