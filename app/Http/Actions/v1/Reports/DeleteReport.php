<?php

namespace App\Http\Actions\v1\Reports;

use App\Models\EquipmentReport;

class DeleteReport
{
    protected array $response;

    public function execute(int $id): self
    {
        $model = EquipmentReport::findOrFail($id);

        $this->response = [
            'result' => $model->softDelete()
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
