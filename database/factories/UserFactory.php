<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'status_id' => $this->faker->randomElement([UserStatus::S_ACTIVE, UserStatus::S_PENDING, UserStatus::S_SUSPENDED, UserStatus::S_EXPIRED]),
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => password_hash($this->faker->password, PASSWORD_ARGON2I),
            'expires_at' => now()->modify('+' . rand(2, 14) . ' months'),
            'config' => [
                'requireEmailConfirmation' => false,
                'autoGeneratePassword' => false,
                'requirePasswordChangeOnFirstLogin' => true,
                'passwordChangedOnFirstLogin' => false,
            ]
        ];
    }
}
