<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Card;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function update(Card $card, Basket $basket): RedirectResponse
    {
        abort_if(
            $card->user_id != auth()->id(),
            403,
            "You can't close this basket!");

        $basket->update(['closed' => true]);

        return redirect()->route("cards.index");
    }
}
