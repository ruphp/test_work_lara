<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
            'name' => fake()->words(3, true).' '.fake()->numberBetween(10, 99),
            'price' => fake()->randomFloat(2, 100, 100000),
            'category_id' => Category::factory(),
            'in_stock' => fake()->boolean(75),
            'rating' => fake()->randomFloat(1, 0, 5),
            'created_at' => fake()->dateTimeBetween('-1 year'),
            'updated_at' => now(),
        ];
    }
}
