<?php

namespace App\Http\Actions\v1\Properties;

use App\DTO\PropertyDTO;
use App\Models\Property;
use App\Models\PropertyView;

class CreateProperty
{
    protected array $response;

    public function execute(PropertyDTO $dto)
    {
        $model = Property::create([
            'client_id' => $dto->client_id,
            'title' => $dto->title,
            'description' => $dto->description,
            'address_formatted' => $dto->address_formatted,
            'postcode' => $dto->postcode,
        ]);

        $this->response = $model->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
