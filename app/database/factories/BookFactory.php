<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'images' => null,
            'title' => $this->faker->sentence,
            'publisher' => $this->faker->company,
            'description' => $this->faker->text(500),
            'released_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'stock' => $this->faker->numberBetween(0, 100),
            'cost' => $this->faker->randomFloat(2, 0, 100),
            'genre_id' => \App\Models\Genre::factory()->create()->id,
            'author_id' => \App\Models\Author::factory()->create()->id,
        ];
    }
}
