<?php

namespace App\Mail;

use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPasswordResetInstructions extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $reset;

    public function __construct(User $user, PasswordReset $reset)
    {
        $this->user = $user;
        $this->reset = $reset;
    }

    public function build()
    {
        return $this->view('email.reset_password', [
            'full_name' => $this->user->getFullName(),
            'reset_link' => $this->reset->getResetLink()
        ]);
    }
}
