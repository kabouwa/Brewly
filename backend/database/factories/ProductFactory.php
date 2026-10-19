<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
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
        $p_price = fake()->randomFloat(2,10,100);

        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => fake()->unique()->words(random_int(2,4), true),
            'stock' => random_int(0,100),
            'alert_ceil' => random_int(0,10),
            'purchase_price' => $p_price,
            'selling_price' => $p_price + fake()->randomFloat(2,10,100),
            'active' => fake()->boolean()
        ];
    }
}
