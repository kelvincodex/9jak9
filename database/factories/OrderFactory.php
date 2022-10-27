<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
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
            'orderCustomerId' => fake()->uuid(),
            'orderDeliveryFee' => fake()->city(),
            'orderDeliveryState' => fake()->city(),
            'orderDeliveryAddress' => fake()->address(),
            'orderTotalPrice' => fake()->numerify(),
            'orderProductTotalPrice' => fake()->sentence(),
        ];
    }
}
