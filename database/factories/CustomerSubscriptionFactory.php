<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerSubscription>
 */
class CustomerSubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subscription_id' => fake()->numberBetween($min = 1, $max = 100),
            'customer_id' => fake()->numberBetween($min = 1, $max = 100),
            'quantity' => fake()->numberBetween($min = 1, $max = 10),
            'price' =>  fake()->randomElement([5.00, 10.00, 15.00, 20.00, 25.00, 100.00, 200.00, 500.00]),
            'status' => fake()->randomElement(['active', 'disabled']),
            'frequency' => fake()->randomElement(['monthly', 'yearly']),
            'term' =>  fake()->numberBetween($min = 1, $max = 11),
        ];
    }
}
