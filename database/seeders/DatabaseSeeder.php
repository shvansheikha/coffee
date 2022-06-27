<?php

namespace Database\Seeders;

use App\Enums\GroupType;
use App\Models\Basket;
use App\Models\Card;
use App\Models\Game;
use App\Models\Group;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        $coffees = ['Espresso', 'Double Espresso', 'Red Eye', 'Black Eye', 'Long Black', 'Macchiato',
            'Cortado', 'Breve', 'Cappuccino', 'Flat White', 'Cafe Latte', 'Mocha', 'Cafe au Lait', 'Iced Coffee'
        ];

        $juices = ['Sunshine Queen', 'Vacay Juice', 'The Wellness Recipe', 'Fruit Fairy', 'Nature Express',
            'Juice Boulevard', 'Fruit Vengeance', 'Pulp House Co', 'Tropic Magic', 'Fruit Celebrity'];

        $iceCream = ['Chocolate', 'Cookies & Cream', 'Mint Chocolate Chip', 'Chocolate Chip Cookie Dough',
            'Buttered Pecan', 'Birthday Cake'];

        $herbalTea = ['Ginger TeH', 'ibiscus Te', 'Echinacea Te', 'Rooibos Te', 'Sage Te', 'Lemon Balm Tea'];

        $ps4Games = ['One Person', 'Two Person', 'Three Person'];
        $ps5Games = ['One Person', 'Two Person', 'Three Person'];
        $snoGames = ['Snooker'];
        $bilGames = ['billiard'];
        $vrGames = ['VR'];

        $groups = [
            ['title' => 'PS4', 'type' => GroupType::Game, 'children' => $ps4Games],
            ['title' => 'PS5', 'type' => GroupType::Game, 'children' => $ps5Games],
            ['title' => 'SNO', 'type' => GroupType::Game, 'children' => $snoGames],
            ['title' => 'BIL', 'type' => GroupType::Game, 'children' => $bilGames],
            ['title' => 'VR', 'type' => GroupType::Game, 'children' => $vrGames],
            ['title' => 'Coffee', 'type' => GroupType::Product, 'children' => $coffees],
            ['title' => 'Herbal Tea', 'type' => GroupType::Product, 'children' => $herbalTea],
            ['title' => 'Ice Cream', 'type' => GroupType::Product, 'children' => $iceCream],
            ['title' => 'Juice', 'type' => GroupType::Product, 'children' => $juices],
        ];

        $cards = collect();

        $user = User::factory()->create([
            'name' => 'shvana',
            'email' => 'shvansheikha@gmail.com',
        ]);

        foreach ($groups as $group) {
            $model = Group::factory()->create([
                'user_id' => $user->id,
                'title' => $group['title'],
                'type' => $group['type'],
            ]);


            if ($group['type'] == GroupType::Game) {
                foreach ($group['children'] as $child) {
                    Game::factory()->create([
                        'user_id' => $user->id,
                        'group_id' => $model->id,
                        'title' => $child
                    ]);
                }
            }

            if ($group['type'] == GroupType::Product) {
                foreach ($group['children'] as $child) {
                    Product::factory()->create([
                        'user_id' => $user->id,
                        'group_id' => $model->id,
                        'title' => $child
                    ]);
                }
            }
        }

        for ($i = 1; $i < 6; $i++) {
            $card = Card::factory()->create([
                'user_id' => $user->id,
                'title' => 'Card ' . $i,
            ]);

            $cards->add($card);
        }

        for ($d = 8; $d > 0; $d--) {
            for ($i = 1; $i < rand(20, 30); $i++) {
                $card = $cards->random();

                $min = rand(10, 50);
                $basket = Basket::factory()->create([
                    'user_id' => $user->id,
                    'card_id' => $card->id,
                    'created_at' => now()->subDays($d)->addMinutes($min),
                    'closed_at' => now()->subDays($d)->addMinutes($min + rand(40, 60)),
                ]);
            }
        }

    }
}
