<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateAuthentication
{
    protected array $response;

    public function execute(int $user_id, string $username, string $password): self
    {
        DB::transaction(function() use ($user_id, $username, $password)
        {
            /** @var  $user User */
            $user = User::findOrFail($user_id);

            $user->updateEmail($username);
            $user->updatePassword($password);
        });

        $this->response = ['success' => true];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
