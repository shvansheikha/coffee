<?php

namespace Database\Factories;

use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;


class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->words(rand(2, 3), true)
        ];
    }
}
