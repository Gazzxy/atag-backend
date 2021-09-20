<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use App\Models\UsersView;
use App\DTO\SortOptionDTO;

class Listing
{
    protected array $response;

    public function execute(User $user, ?string $query = null, ?SortOptionDTO $sort): self
    {
        $this->response = $user->isAdministrator()
            ?
            UsersView::listing(10, $query, $sort->sort_by, $sort->sort_way)->toArray()
            :
            UsersView::listingFor($user->client_id, $query, 10, $sort->sort_by, $sort->sort_way)->toArray()
        ;

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
