<?php

namespace App\Observers;

use App\Models\Game;
use App\Models\Order;
use App\Models\Product;

class OrderObserver
{
    public function creating(Order $order): void
    {
        $order->amount = $order->orderable->amount;

        if ($order->orderable_type == get_class(new Game) && !$order->isDirty('started_at')) {
            $order->started_at = now();
        }

        if ($order->orderable_type == get_class(new Product)) {
            $order->price = $order->amount * $order->number;
        }
    }
}
