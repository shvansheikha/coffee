<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CardPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

    }

    public function view(User $user, Card $card)
    {

    }

    public function create(User $user)
    {

    }

    public function update(User $user, Card $card): bool
    {
        return $user->id == $card->user_id;
    }

    public function delete(User $user, Card $card): bool
    {
        return $user->id == $card->user_id;
    }
}
