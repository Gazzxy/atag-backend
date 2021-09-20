<?php

namespace App\Http\Actions\v1\Clients;

use App\Models\User;
use App\DTO\ClientDTO;
use App\Models\Client;
use Illuminate\Support\Str;
use App\Events\ClientCreated;
use App\Events\AccountCreated;
use App\DTO\ManagingAccountDTO;
use App\Mail\SendClientCreated;
use App\Models\ClientAccountType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendAccountCreatedNotification;

class CreateClientAndManagingAccount
{
    protected array $response;

    public function execute(ClientDTO $clientDTO, ManagingAccountDTO $accountDTO): self
    {
        DB::transaction(function() use ($clientDTO, $accountDTO)
        {
            // Create the client record
            $client = Client::createFromDTO($clientDTO);

            $clientDTO->public_id = $client->public_id;
            $clientDTO->client_id = $client->id;

            // Handle the account DTO, user password and creation of user record
            $password = $accountDTO->autoGeneratePassword ? Str::random(14) : $accountDTO->password;

            $accountDTO->client_id = $client->id;
            $accountDTO->type_id = ClientAccountType::T_MANAGING_ACCOUNT;
            $accountDTO->hashed_password = password_hash($password, PASSWORD_ARGON2I);
            $accountDTO->password = $password;

            $account = User::createFromDTO($accountDTO);

            // Give the user all permissions
            $account->grantAllPermissions();

            $accountDTO->id = $account->id;

            event(new ClientCreated($client));
            event(new AccountCreated($account, ClientAccountType::T_MANAGING_ACCOUNT, $password));

            if($accountDTO->sendNotificationEmail && $accountDTO->requireEmailConfirmation)
            {
                Mail::to($accountDTO->email)->send(new SendClientCreated($clientDTO, $accountDTO));
            }
            else
            {
                if($accountDTO->sendNotificationEmail)
                {
                    Mail::to($accountDTO->email)->send(new SendAccountCreatedNotification($accountDTO));
                }
            }

            $this->response = [
                'client_id' => $client->id,
                'account_id' => $account->id,
            ];
        });

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
