<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'transactionid' => $this->faker->unique()->randomNumber(8, true),
            'amount' => $this->faker->randomFloat(2, 0, 1000.00),
            'date' => $this->faker->date(),
            'client_id' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
