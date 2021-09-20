<?php

namespace App\Http\Actions\v1\Users;

use function App\Helpers\verifyResetPasswordPayload;

class VerifyPasswordResetPayload
{
    protected array $response;

    public function execute(string $payload): self
    {
        $this->response = ['success' => true];

        return $this;

        $this->response = verifyResetPasswordPayload($payload);

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
