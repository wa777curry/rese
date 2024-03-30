<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(2, 10),
            'shop_id' => $this->faker->numberBetween(1, 20),
            'rating' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->realText(100, 5),
        ];
    }
}
