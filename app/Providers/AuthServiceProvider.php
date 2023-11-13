<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Basket;
use App\Models\Card;
use App\Models\Game;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use App\Policies\BasketPolicy;
use App\Policies\CardPolicy;
use App\Policies\GamePolicy;
use App\Policies\GroupPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Group::class => GroupPolicy::class,
        Card::class => CardPolicy::class,
        Product::class => ProductPolicy::class,
        Game::class => GamePolicy::class,
        Basket::class => BasketPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
