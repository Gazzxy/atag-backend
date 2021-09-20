<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use App\Models\PasswordReset;
use function App\Helpers\verifyResetPasswordPayload;

class ChangePasswordViaReset
{
    protected array $response;

    public function execute(string $payload, string $password): self
    {
        $verified = verifyResetPasswordPayload($payload);

        if(!$verified['success'])
        {
            $this->response['success'] = false;

            return $this;
        }

        $decrypted = json_decode(decrypt($payload), true);

        $reset = PasswordReset::findOrFail($decrypted['id']);

        /** @var  $user User */
        $user = User::findOrFail($reset->user_id);

        $result = $user->updatePassword($password);

        $reset->delete();

        $this->response = ['success' => $result];

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
