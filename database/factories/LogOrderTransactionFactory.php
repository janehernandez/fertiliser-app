<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogOrderTransaction>
 */
class LogOrderTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'       => User::factory(),
            'order_id'      => Order::factory(),
            'product_id'    => Product::factory(),
            'quantity'      => $this->faker->randomNumber(3),
            'availed_price' => $this->faker->randomFloat(0, 5, 50),
            'total_price'   => $this->faker->randomFloat(0, 5, 50),
        ];
    }
}
