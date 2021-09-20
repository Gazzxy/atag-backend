<?php

namespace App\Http\Actions\v1\Properties;

use App\DTO\PropertyDTO;
use App\Models\Property;
use App\Models\PropertyView;

class UpdateProperty
{
    protected array $response;

    public function execute(PropertyDTO $dto, int $id)
    {
        /** @var  $model Property */
        $model = Property::findOrFail($id);

        $result = $model->update([
            'title' => $dto->title,
            'description' => $dto->description,
            'address_formatted' => $dto->address_formatted,
            'postcode' => $dto->postcode,
        ]);

        $this->response = ['result' => $result];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
