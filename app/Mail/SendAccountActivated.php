<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\DTO\AccountActivatedDTO;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAccountActivated extends Mailable
{
    use Queueable, SerializesModels;

    protected AccountActivatedDTO $dto;

    public function __construct(AccountActivatedDTO $dto)
    {
        $this->dto = $dto;
    }

    public function build()
    {
        return $this
            ->view('email.account_activated',
                [
                    'name' => $this->dto->name,
                    'username' => $this->dto->username,
                    'app_url' => $this->dto->app_url
                ]
            )->subject(config('brightfm.email.accountVerified.title'))
            ;
    }
}
