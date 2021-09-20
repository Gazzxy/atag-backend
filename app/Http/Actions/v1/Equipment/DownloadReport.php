<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\EquipmentReport;
use Illuminate\Support\Facades\Storage;

class DownloadReport
{
    public function execute(int $id)
    {
        $model = EquipmentReport::findOrFail($id);

        $name = $model->filename;

        return Storage::disk('reports')->download($model->filepath, $name);
    }
}
