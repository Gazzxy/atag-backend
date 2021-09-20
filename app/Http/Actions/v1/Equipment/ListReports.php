<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\EquipmentReportView;

class ListReports
{
    protected array $response;

    public function execute(int $id)
    {
        $this->response = EquipmentReportView::getReportListFor($id);

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
