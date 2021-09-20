<?php

namespace App\Mail;

use App\DTO\ClientDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\DTO\ManagingAccountDTO;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendClientCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected ClientDTO $client;
    protected ManagingAccountDTO $account;

    public function __construct(ClientDTO $client, ManagingAccountDTO $account)
    {
        $this->client = $client;
        $this->account= $account;
    }

    public function build()
    {
        $payload = [
            'client_id' => $this->client->client_id,
            'public_id' => $this->client->public_id,
            'account_id' => $this->account->id,
        ];

        return $this->view('email.client_created', [
            'client_name' => $this->client->title,
            'username' => $this->account->email,
            'app_url' => config('brightfm.url'),
            'confirm_url' => $this->getClientConfirmationURL($payload)
        ])
            ->subject(config('brightfm.email.accountCreated.title'));
    }

    protected function getClientConfirmationURL(array $payload): string
    {
        return sprintf("%s%s%s",
            config('brightfm.url'),
            config('brightfm.confirmClientPath'),
            encrypt($payload)
        );
    }
}
