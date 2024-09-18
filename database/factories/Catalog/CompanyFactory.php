<?php

namespace Database\Factories\Catalog;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'business_name' => fake()->company(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->numberBetween(10000, 99999),
            'created_by' => fake()->name(),
            'updated_by' => fake()->name()
            //
        ];
    }
}
