<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

class EmailSendingTest extends TestCase
{
    public function testEmailSendingWorks()
    {
        $mail_address = env('TEST_MAIL_ADDRESS');

        Mail::to($mail_address)->send(new TestMail());

        $result = Mail::failures();

        $this->assertTrue(empty($result));
    }
}
