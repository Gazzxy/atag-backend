<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\Equipment;

class Update
{
    protected array $response;

    public function execute(int $id, array $data): self
    {
        /** @var  $model Equipment */
        $model = Equipment::findOrFail($id);

        $this->response = ['result' => $model->update($data)];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
