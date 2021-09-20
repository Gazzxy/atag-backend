<?php

namespace Tests\Feature\API\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientAPITest extends TestCase
{
//    public function testCreateClientFails()
//    {}
//
//    public function testCreateClientSucceeds()
//    {}
//
//    public function testClientUserListingFails()
//    {}
//
//    public function testClientUserListingSucceeds()
//    {}
//

    public function testClientAccountTypesListingSucceeds()
    {
        $response = $this->actingAs($this->getUser())->get('/api/v1/clients/account-types');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            0 => ['id', 'title', 'description', 'config']
        ]);
    }

    public function testClientStatusListingSucceeds()
    {
        $response = $this->actingAs($this->getUser())->get('/api/v1/clients/statuses');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            0 => ['id', 'title', 'description']
        ]);
    }

    /**
     * @return int
     */
    public function testClientListingSucceeds(): int
    {
        $response = $this->actingAs($this->getUser())->get('/api/v1/clients');

        $response->assertStatus(200);

        $id = $response->json()['data'][0]['id'];

        return $id;
    }

    /**
     * @depends testClientListingSucceeds
     * @param int $client_id
     */
    public function testPropertyListingSucceeds(int $client_id)
    {
        $response = $this->actingAs($this->getUser())->get("/api/v1/client/$client_id/properties");

        $response->assertStatus(200);
    }

    /**
     * @depends testClientListingSucceeds
     * @param int $client_id
     */
    public function testEquipmentListingSucceeds(int $client_id)
    {
        $response = $this->actingAs($this->getUser())->get("/api/v1/client/$client_id/equipment");

        $response->assertStatus(200);
    }

    protected function getUser()
    {
        return User::where('is_administrator', 1)->firstOrFail();
    }
}
