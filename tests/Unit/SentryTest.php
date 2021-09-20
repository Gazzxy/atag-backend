<?php

namespace Tests\Unit;

use Tests\TestCase;

class SentryTest extends TestCase
{
    public function testSentryReceivesError()
    {
        $this
            ->artisan('sentry:test')
            ->assertExitCode(0);
    }
}
