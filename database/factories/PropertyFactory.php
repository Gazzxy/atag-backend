<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition()
    {
        return [
            'title' => $this->faker->streetName,
            'description' => $this->faker->text(200),
            'address_formatted' => $this->faker->streetAddress,
            'address_line_1' => $this->faker->streetAddress,
            'address_line_2' => $this->faker->streetSuffix,
            'city' => $this->faker->city,
            'postcode' => $this->faker->postcode
        ];
    }
}
