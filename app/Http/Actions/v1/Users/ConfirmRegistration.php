<?php

namespace App\Http\Actions\v1\Users;

use App\Models\User;
use App\Models\Client;
use App\DTO\AccountActivatedDTO;
use Illuminate\Support\Facades\DB;
use App\Mail\SendAccountActivated;
use Illuminate\Support\Facades\Mail;
use App\DTO\DecryptedConfirmationDTO;

class ConfirmRegistration
{
    protected array $response = [];

    public function execute(string $slug, string $password): self
    {
        try
        {
            DB::transaction(function() use ($slug, $password)
            {
                $dto = new DecryptedConfirmationDTO(decrypt(urldecode($slug)));

                /** @var  $client Client */
                $client = Client::findOrFail($dto->client_id);

                /** @var  $user User */
                $user = User::findOrFail($dto->account_id);

                if($user->isSuspended())
                {
                    $this->response = [
                        'success' => false,
                        'message' => 'Account is suspended'
                    ];
                }
                elseif($user->isExpired())
                {
                    $this->response = [
                        'success' => false,
                        'message' => 'Account expired'
                    ];
                }
                elseif(!$user->isActive())
                {
                    $user->updatePassword($password);
                    $user->setActive();
                    $user->setRequirePasswordChange(false);
                    $client->setActive();

                    $dto = new AccountActivatedDTO([
                        'name' => $user->getFullName(),
                        'username' => $user->getEmail(),
                        'app_url' => config('brightfm.url')
                    ]);

                    // Send the email
                    Mail::to($user->getEmail())->send(new SendAccountActivated($dto));

                    $this->response = [
                        'success' => true
                    ];
                }
                else
                {
                    $this->response = [
                        'success' => false,
                        'message' => 'The confirmation link is expired'
                    ];
                }
            });
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
