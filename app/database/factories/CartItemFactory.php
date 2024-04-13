<?php

namespace Database\Factories;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'count' => $this->faker->numberBetween(1, 10),
            'book_id' => \App\Models\Book::factory()->create()->id,
            'cart_id' => \App\Models\ShoppingCart::factory()->create()->id,
        ];
    }
}
