<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\EquipmentReport;
use Illuminate\Support\Facades\Storage;

class DownloadReportByUUID
{
    public function execute(int $id)
    {
        $model = EquipmentReport::where('public_id', $id);

        $name = $model->filename;

        return Storage::disk('reports')->download($model->filepath, $name);
    }
}
