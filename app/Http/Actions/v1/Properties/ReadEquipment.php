<?php

namespace App\Http\Actions\v1\Properties;

use App\Models\PropertyView;
use App\Models\EquipmentView;

class ReadEquipment
{
    protected array $response;

    public function execute(int $id): self
    {
        $collection = EquipmentView::where('property_id', $id)->where('deleted', 0)->get();

        $this->response = $collection->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
