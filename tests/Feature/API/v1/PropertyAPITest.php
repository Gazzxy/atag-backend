<?php

namespace Tests\Feature\API\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertyAPITest extends TestCase
{
    protected function getUser()
    {
        return User::where('is_administrator', 1)->firstOrFail();
    }
}
