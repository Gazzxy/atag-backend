<?php

namespace Database\Factories;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    protected $model = Equipment::class;

    public function definition()
    {
        return [
            'public_id' => $this->faker->uuid,
            'title' => $this->faker->word,
            'description' => $this->faker->text(100),
            'metadata' => [
                'code' => $this->faker->randomNumber(rand(5, 9)),
                'serial' => $this->faker->randomNumber(9),
                'location' => $this->faker->domainWord,
                'location_image_url' => '',
                'make' => $this->faker->domainWord,
                'model' => $this->faker->domainWord,
                'qr_value' => $this->faker->domainWord,
                'size' => $this->faker->randomNumber(5),
                'size_unit' => $this->faker->domainWord,
            ],
            'installed_at' => now()->modify('-' . rand(200, 730) .' days'),
            'last_service_at' => now()->modify('-' . rand(12, 90) .' days'),
            'expires_at' => now()->modify('+' . rand(60, 180) . ' days')
        ];
    }
}
