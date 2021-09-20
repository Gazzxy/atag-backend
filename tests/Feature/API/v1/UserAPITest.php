<?php

namespace Tests\Feature\API\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAPITest extends TestCase
{
    public function testUserListingSucceeds()
    {
        $response = $this->actingAs($this->getUser())->get('/api/v1/users');

        $response->assertStatus(200);

        $id = $response->json()['data'][0]['id'];

        return $id;
    }

    public function testUserTypesListingSucceeds()
    {
        $response = $this->actingAs($this->getUser())->get('/api/v1/users/types');

        $response->assertStatus(200);

        $response->assertJsonStructure(['id', 'title'], $response->json()[0]);
    }

    protected function getUser()
    {
        return User::where('is_administrator', 1)->firstOrFail();
    }
}
