<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\EquipmentReportView;

class ListReportsByUUID
{
    protected array $response;

    public function execute(string $id)
    {
        $this->response = EquipmentReportView::getReportListForByUUID($id);

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
