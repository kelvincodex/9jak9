<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

            return [
                'deliveryState' => fake()->city(),
                'deliveryStatus' => fake()->name(),
                'deliveryFee' => fake()->randomNumber(),
                'deliveryDescription' => fake()->sentence(),
            ];

    }
}
