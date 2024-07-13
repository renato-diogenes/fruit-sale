<?php

namespace Database\Factories;

use App\Enums\FruitCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fruit>
 */
class FruitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['banana', 'apple', 'orange']),
            'classification' => fake()->randomElement(FruitCategory::toArray()),
            'fresh' => fake()->boolean(),
            'quantity' => fake()->randomDigit(),
            'price' => fake()->randomFloat(2, 0.01, 10),
        ];
    }
}
