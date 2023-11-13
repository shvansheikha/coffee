<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;


class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->words(rand(2, 4), true),
            'amount' => $this->faker->randomFloat(2, 1000, 10000)
        ];
    }
}
