<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'productName' => $this->faker->name,
            'amountAvailable' => $this->faker->numberBetween(1, 100),
            'cost' => $this->faker->numberBetween(0, 100), 
            'sellerId' => User::all()->random()->id, 
        ];
    }
}
