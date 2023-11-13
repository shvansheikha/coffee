<?php

namespace Database\Factories;

use App\Enums\GroupType;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;


class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->words(2, true),
            'type' => GroupType::Product,
        ];
    }
}
