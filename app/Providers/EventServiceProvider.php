<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\Order;
use App\Observers\BasketObserver;
use App\Observers\OrderObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot()
    {
        Order::observe(OrderObserver::class);
        Basket::observe(BasketObserver::class);
    }

    public function shouldDiscoverEvents()
    {
        return false;
    }
}
