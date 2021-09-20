<?php

namespace App\Http\Actions\v1\Users;

use App\Models\ClientAccountType;

class Types
{
    protected array $response;

    public function execute(): self
    {
        $types = ClientAccountType::orderBy('id', 'ASC')->get()->all();

        $this->response = $types;

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
