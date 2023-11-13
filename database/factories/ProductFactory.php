<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->words(rand(2, 4), true),
            'amount' => $this->faker->randomFloat(2, 10, 50)
        ];
    }
}
