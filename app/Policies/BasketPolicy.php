<?php

namespace App\Policies;

use App\Models\Basket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasketPolicy
{
    use HandlesAuthorization;

    public function see(User $user, Basket $basket)
    {
        return $user->id == $basket->user_id;
    }

    public function update(User $user, Basket $basket): bool
    {
        return $user->id == $basket->user_id;
    }

    public function delete(User $user, Basket $basket): bool
    {
        return $user->id == $basket->user_id;
    }
}
