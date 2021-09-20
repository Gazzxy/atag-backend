<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateInfo
{
    protected array $response;

    public function execute(int $user_id, string $full_name, int $status_id, int $type_id, string $expires_at = null): self
    {
        DB::transaction(function() use ($user_id, $full_name, $status_id, $type_id, $expires_at)
        {
            /** @var  $model User */
            $model = User::findOrFail($user_id);

            $result = $model->update([
                'full_name' => $full_name,
                'status_id' => $status_id,
                'type_id' => $type_id,
                'expires_at' => $expires_at
            ]);

            $this->response = ['success' => $result];
        });

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
