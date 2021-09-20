<?php

namespace App\Http\Actions\v1\Equipment;

use App\Models\User;
use App\DTO\SortOptionDTO;
use App\Models\EquipmentView;

class Listing
{
    private array $response;

    public function execute(User $user, ?string $query = null, ?SortOptionDTO $sort): self
    {
        $this->response = $user->isAdministrator()
            ?
            EquipmentView::listing(10, $query, $sort->sort_by, $sort->sort_way)->toArray()
            :
            EquipmentView::listingFor($user->client_id, $query, 10, $sort->sort_by, $sort->sort_way)->toArray()
        ;

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
