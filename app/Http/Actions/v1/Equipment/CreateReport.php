<?php

namespace App\Http\Actions\v1\Equipment;

use Illuminate\Support\Str;
use App\DTO\EquipmentReportDTO;
use App\Models\EquipmentReport;
use Illuminate\Support\Facades\Storage;

class CreateReport
{
    protected array $response;

    public function execute(int $equipment_id, EquipmentReportDTO $dto): self
    {
        // Create the file and save it to storage disk
        $path = sprintf("%s/%s", now()->format('Y-m-d'), Str::uuid());

        $result = Storage::disk('reports')->put($path, base64_decode($dto->file_contents));

        if(!$result)
        {
            throw new \Exception("Unable to save report file to destination: ". $path);
        }

        // Create DB entry
        $model = EquipmentReport::create([
            'equipment_id' => $equipment_id,
            'user_id' => $dto->user_id,
            'title' => $dto->title,
            'filename' => $dto->filename,
            'filepath' => $path,
            'url' => '',
        ]);

        $this->response = $model->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
