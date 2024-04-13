<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'address_address' => $this->faker->address,
            'zipcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'status' => 'pending',
            'user_id' => null,
        ];
    }
}
