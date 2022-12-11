<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name'          => $this->faker->word(),
            'code'          => $this->faker->numerify('FRT-#####'),
            'quantity'      => $this->faker->randomNumber(3),
            'unit_price'    => $this->faker->randomFloat(0, 5, 50),
        ];
    }
}
