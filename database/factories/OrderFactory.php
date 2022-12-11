<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'           => User::factory(),
            'order_no'          => 'PRC-1' . '-' . now()->timestamp,
            'total_quantity'    => $this->faker->randomNumber(3),
            'total_amount'      => $this->faker->randomFloat(0, 5, 50),
        ];
    }
}
