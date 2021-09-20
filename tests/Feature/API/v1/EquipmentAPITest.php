<?php

namespace Tests\Feature\API\v1;

use App\Models\User;
use App\Models\PropertyView;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EquipmentAPITest extends TestCase
{
    use WithFaker;

    public function testCreateFails()
    {
        $result = $this->actingAs($this->getUser())->post('/api/v1/equipment');

        $result->assertStatus(422);
    }

    public function testCreateSucceeds(): int
    {
        $result = $this->actingAs($this->getUser())->post('/api/v1/equipment', [
            'property_id' => PropertyView::first()->id,
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'installed_at' => now()->modify('-1 day')->format('Y-m-d'),
            'last_service_at' => now()->format('Y-m-d'),
            'expires_at' => now()->modify('+1 year')->format('Y-m-d'),
            'metadata' => [
                'code' => $this->faker->word,
                'serial' => $this->faker->randomNumber(5),
                'location' => $this->faker->word,
                'make' => $this->faker->word,
                'model' => $this->faker->word,
                'qr_value' => $this->faker->word,
                'size' => $this->faker->numberBetween(20, 1000),
                'size_unit' => $this->faker->word,
            ]
        ]);

        $result->assertStatus(200);

        return $result->json('id');
    }

    /**
     * @depends testCreateSucceeds
     * @param int $id
     */
    public function testReadSucceeds(int $id)
    {
        $result = $this->actingAs($this->getUser())->get('/api/v1/equipment/'. $id);

        $result->assertStatus(200);
    }

    protected function getUser()
    {
        return User::where('is_administrator', 1)->firstOrFail();
    }
}
