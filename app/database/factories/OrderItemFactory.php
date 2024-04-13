<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'author_name' => $this->faker->name,
            'count' => $this->faker->numberBetween(1, 10),
            'total_cost' => $this->faker->randomFloat(2, 0, 100),
            'order_id' => \App\Models\Order::factory()->create()->id,
        ];
    }
}
