<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Game;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'shvana',
            'email' => 'shvansheikha@gmail.com',
        ]);

        Card::factory()->count(5)->create(['user_id' => $user->id]);

        Product::factory()->count(20)->create(['user_id' => $user->id]);

        Game::factory()->count(10)->create(['user_id' => $user->id]);
    }
}
