<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'orderId' => $this->faker->unique()->orderId,
            'customerId' => $this->faker->customerId, 
            'orderDate' => $this->faker->orderDate,
            'orderTotal' => $this->faker->orderTotal,
        ];
    }
}
