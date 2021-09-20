<?php

namespace App\Http\Actions\v1\Permissions;

use App\Models\Permission;

class Listing
{
    protected array $response;

    public function execute(): self
    {
        $this->response = Permission::all()->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
