<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use App\Models\Client;
use App\DTO\DecryptedConfirmationDTO;
use Illuminate\Contracts\Encryption\DecryptException;

class VerifyConfirmation
{
    protected array $response = [];

    public function execute(string $slug): self
    {
        try
        {
            $dto = new DecryptedConfirmationDTO(decrypt(urldecode($slug)));

            /** @var  $client Client */
            $client = Client::findOrFail($dto->client_id);

            /** @var  $user User */
            $user = User::findOrFail($dto->account_id);

            if(!$user->isActive())
            {
                $this->response = [
                    'success' => true,
                    'name' => $user->getFullName(),
                    'email' => $user->getEmail(),
                    'client' => $user->getClientName()
                ];
            }
            else
            {
                $this->response = [
                    'success' => false,
                    'message' => 'The confirmation link is expired'
                ];
            }
        }
        catch(\Exception $e)
        {
        }

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
