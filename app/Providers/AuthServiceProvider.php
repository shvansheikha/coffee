<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Game;
use App\Models\Group;
use App\Models\Product;
use App\Policies\CardPolicy;
use App\Policies\GamePolicy;
use App\Policies\GroupPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Group::class => GroupPolicy::class,
        Card::class => CardPolicy::class,
        Product::class => ProductPolicy::class,
        Game::class => GamePolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
