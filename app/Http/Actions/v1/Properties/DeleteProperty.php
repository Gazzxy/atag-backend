<?php


namespace App\Http\Actions\v1\Properties;

use App\Models\Property;

class DeleteProperty
{
    protected array $response;

    public function execute(int $id): self
    {
        $model = Property::findOrFail($id);

        $this->response = [
            'result' => $model->softDelete()
        ];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
