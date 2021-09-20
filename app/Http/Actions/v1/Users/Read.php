<?php

namespace App\Http\Actions\v1\Users;

use App\Models\UsersView;

class Read
{
    protected array $response;

    public function execute(int $id): self
    {
        $user = UsersView::findOrFail($id);

        $this->response = $user->toArray();

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
