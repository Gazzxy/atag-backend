<?php

namespace App\Http\Actions\v1\Properties;

use App\Models\PropertyView;

class Read
{
    protected array $response;

    public function execute(int $id): self
    {
        $model = PropertyView::findOrfail($id);

        $this->response = $model->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
