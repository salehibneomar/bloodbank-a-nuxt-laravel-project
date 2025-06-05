<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\UserRole;
use App\Models\User;

class AdminFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
            'role' =>  UserRole::Admin->value,
            'is_active' => true,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
