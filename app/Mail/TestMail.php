<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        $address = 'nikola@gymware.io';
        $subject = 'This is a demo!';
        $name = 'Gymware Test';

        return $this->view('email.test', ['message' => 'A test message'])
            ->from($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ;
    }
}
