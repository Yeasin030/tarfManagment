<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turf>
 */
class TurfFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->company() . ' Turf';
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'opening_time' => '06:00:00',
            'closing_time' => '23:00:00',
            'turf_type' => fake()->randomElement(['5-a-side', '7-a-side', '11-a-side']),
            'capacity' => fake()->randomElement([10, 14, 22]),
            'starting_price' => fake()->randomFloat(2, 50, 150),
            'is_active' => true,
        ];
    }
}
