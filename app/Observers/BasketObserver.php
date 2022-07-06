<?php

namespace App\Observers;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class BasketObserver
{
    public function updating(Basket $basket): void
    {
        if ($basket->isDirty('closed') && $basket->closed) {

            $totalPrice = Order::query()
                ->select(DB::raw("SUM(price) as total_price"))
                ->ofUser(auth()->user())
                ->ofBasket($basket)
                ->first()
                ->total_price;

            $basket->closed_at = now();
            $basket->total_price = $totalPrice;
        }
    }
}
