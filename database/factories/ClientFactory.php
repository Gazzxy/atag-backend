<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ClientStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'public_id' => $this->faker->uuid,
            'status_id' => ClientStatus::randomStatus(),
            'title' => $this->faker->company,
            'description' => $this->faker->text(250),
            'address' => $this->faker->address,
            'theme' => [],
            'expires_at' => now()->modify('+' . rand(30, 230) .' days'),
            'deleted_at' => null,
            'last_login_at' => now()->modify('+' . rand(0, 74) .' hours'),
        ];
    }
}
