<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\DTO\ManagingAccountDTO;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccountCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected ManagingAccountDTO $dto;

    public function __construct(ManagingAccountDTO $dto)
    {
        $this->dto = $dto;
    }

    public function build()
    {
        return $this
            ->view('email.account_created', ['data' => $this->dto])
            ->subject(config('brightfm.email.accountCreated.title'))
            ;
    }
}
