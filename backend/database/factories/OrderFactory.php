<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['PENDING','PREPARING','READY','COMPLETED','CANCELED'];

        return [
            'note' => fake()->sentences(random_int(0,5), true),
            'total_price' => fake()->randomFloat(2,100,800),
            'status' =>  $status[array_rand($status)],
            'table' => random_int(1,50)
        ];
    }
}
