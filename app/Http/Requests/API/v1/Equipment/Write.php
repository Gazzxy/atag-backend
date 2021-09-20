<?php

namespace App\Http\Requests\API\v1\Equipment;

use App\DTO\Equipment;
use App\DTO\EquipmentMetadata;
use App\Rules\DateMultiFormat;
use Illuminate\Foundation\Http\FormRequest;
use function App\Helpers\dateFromFormats;

class Write extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'property_id' => 'required',
            'title' => 'required',
            'installed_at' => ['required', new DateMultiFormat()],
            'last_service_at' => ['sometimes', new DateMultiFormat()],
            'expires_at' => ['sometimes', new DateMultiFormat()]
        ];
    }

    public function getModelData(): array
    {
        return [
            'property_id' => $this->input('property_id'),
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'installed_at' => $this->getDate('installed_at'),
            'last_service_at' => $this->getDate('last_service_at'),
            'expires_at' => $this->getDate('expires_at'),
            'metadata' => [
                'code' => $this->input('metadata.code'),
                'serial' => $this->input('metadata.serial'),
                'location' => $this->input('metadata.location'),
                'location_image' => $this->input('metadata.location_image'),
                'location_image_name' => $this->input('metadata.location_image_name'),
                'make' => $this->input('metadata.make'),
                'model' => $this->input('metadata.model'),
                'qr_value' => $this->input('metadata.qr_value'),
                'size' => $this->input('metadata.size'),
                'size_unit' => $this->input('metadata.size_unit'),
            ]
        ];
    }

    public function getModelDTO(): Equipment
    {
        return new Equipment([
            'property_id' => $this->input('property_id'),
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'installed_at' => $this->getDate('installed_at'),
            'last_service_at' => $this->getDate('last_service_at'),
            'expires_at' => $this->getDate('expires_at'),
            'metadata' => new EquipmentMetadata([
                'code' => $this->input('metadata.code'),
                'serial' => $this->input('metadata.serial'),
                'location' => $this->input('metadata.location'),
                'location_image' => $this->input('metadata.location_image'),
                'location_image_name' => $this->input('metadata.location_image_name'),
                'make' => $this->input('metadata.make'),
                'model' => $this->input('metadata.model'),
                'qr_value' => $this->input('metadata.qr_value'),
                'size' => $this->input('metadata.size'),
                'size_unit' => $this->input('metadata.size_unit'),
            ])
        ]);
    }

    protected function getDate(string $which, $default = null): string
    {
        $input = $this->input($which, $default);

        if(empty($input)) return $default;

        return dateFromFormats($input, 'Y-m-d H:i:s');
    }
}
