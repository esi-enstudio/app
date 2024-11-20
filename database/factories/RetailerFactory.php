<?php

namespace Database\Factories;

use App\Models\Retailer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Retailer>
 */
class RetailerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dd_house_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->numberBetween(1, 300),
            'rso_id' => fake()->numberBetween(1, 25),
            'zm_number' => fake()->e164PhoneNumber(),
            'manager_number' => fake()->e164PhoneNumber(),
            'supervisor_number' => fake()->e164PhoneNumber(),
            'code' => fake()->postcode(),
            'name' => fake()->name(),
            'number' => fake()->e164PhoneNumber,
        ];
    }
}
