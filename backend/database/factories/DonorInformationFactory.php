<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DonorInformation;
use App\Enums\BloodGroup;

class DonorInformationFactory extends Factory
{
    protected $model = DonorInformation::class;

    public function definition(): array
    {
        return [
            'address' => fake()->address(),
            'blood_group' => fake()->randomElement(BloodGroup::allGroups()),
            'is_available' => fake()->randomElement([true, false, true, true]),
            'profession' => fake()->jobTitle(),
            'age' => fake()->numberBetween(18, 60),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
