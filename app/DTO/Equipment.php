<?php

namespace App\DTO;

use Illuminate\Support\Str;
use App\Helpers\DataTransferObject;

class Equipment extends DataTransferObject
{
    public int $property_id;
    public string $title;
    public ?string $description;
    public ?string $installed_at;
    public ?string $last_service_at;
    public ?string $expires_at;
    public EquipmentMetadata $metadata;

    public function toArray(): array
    {
        return [
            'public_id' => Str::uuid(),
            'property_id' => $this->property_id,
            'title' => $this->title,
            'description' => $this->description,
            'installed_at' => $this->installed_at,
            'last_service_at' => $this->last_service_at,
            'expires_at' => $this->expires_at,
            'metadata' => [
                'code' => $this->metadata->code,
                'serial' => $this->metadata->serial,
                'location' => $this->metadata->location,
                'location_image' => $this->metadata->location_image,
                'location_image_name' => $this->metadata->location_image_name,
                'make' => $this->metadata->make,
                'model' => $this->metadata->model,
                'size' => $this->metadata->size,
                'size_unit' => $this->metadata->size_unit,
            ]
        ];
    }
}
