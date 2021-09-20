<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class EquipmentReportDTO extends DataTransferObject
{
    public int $equipment_id;
    public int $user_id;
    public string $title;
    public string $filename;
    public string $file_contents;
}
