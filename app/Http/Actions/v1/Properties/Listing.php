<?php

namespace App\Http\Actions\v1\Properties;

use App\Models\User;
use App\DTO\SortOptionDTO;
use App\Models\PropertyView;

class Listing
{
    protected array $response;

    public function execute(User $user, ?string $query = null, ?SortOptionDTO $sort)
    {
        $this->response = $user->isAdministrator()
            ?
            PropertyView::listing(10, $query, $sort->sort_by, $sort->sort_way)->toArray()
            :
            PropertyView::listingFor($user->client_id, $query, 10, $sort->sort_by, $sort->sort_way)->toArray()
        ;

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
