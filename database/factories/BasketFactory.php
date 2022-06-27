<?php

namespace Database\Factories;

use App\Models\Basket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class BasketFactory extends Factory
{
    protected $model = Basket::class;

    public function definition(): array
    {
        return [
            'user_id' => 1,
            'card_id' => 1,
            'closed' => true,
            'total_price' => rand(50000, 300000),
        ];
    }
}
