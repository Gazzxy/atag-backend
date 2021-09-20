<?php

namespace App\Http\Actions\v1\Clients;

use Faker;
use App\Models\User;
use App\DTO\SortOptionDTO;
use App\Models\ClientsView;

class Listing
{
    protected array $response;

    public function execute(User $user, ?string $query = null, ?SortOptionDTO $sort = null)
    {
        $this->response = $user->isAdministrator()
            ?
            ClientsView::listing(10, $query, $sort->sort_by, $sort->sort_way)->toArray()
            :
            ClientsView::listingFor($user->client_id, $query, 10, $sort->sort_by, $sort->sort_way)->toArray()
        ;

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
