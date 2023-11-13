<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Order $order): bool
    {
        return $user->id == $order->user_id;
    }


    public function delete(User $user, Order $order): bool
    {
        return $user->id == $order->user_id;
    }
}
