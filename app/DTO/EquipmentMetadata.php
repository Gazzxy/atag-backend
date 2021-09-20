<?php

namespace App\DTO;

use App\Helpers\DataTransferObject;

class EquipmentMetadata extends DataTransferObject
{
    public ?string $code;
    public ?string $serial;
    public ?string $location;
    public ?string $location_image;
    public ?string $location_image_name;
    public ?string $make;
    public ?string $model;
    public ?string $qr_value;
    public ?string $size;
    public ?string $size_unit;
}
