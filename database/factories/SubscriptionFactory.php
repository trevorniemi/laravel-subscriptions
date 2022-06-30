<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->catchPhrase(),
            'company_id' => fake()->numberBetween($min = 1, $max = 50),
            'price' =>  fake()->randomElement([5.00, 10.00, 15.00, 20.00, 25.00, 100.00, 200.00, 500.00]),
            'frequency' => fake()->randomElement(['monthly', 'yearly'])
        ];
    }
}
