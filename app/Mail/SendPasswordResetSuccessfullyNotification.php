<?php

namespace App\Mail;

use App\DTO\UserInfoDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordResetSuccessfullyNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected UserInfoDTO $user;

    public function __construct(UserInfoDTO $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('email.password_changed', $this->user->toArray());
    }
}
