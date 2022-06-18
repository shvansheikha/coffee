<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        $cards = $user->cards;

        return view('cards.index', ['cards' => $cards]);
    }

    public function edite(Card $card): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $card->user_id != auth()->user()->id,
            403,
            "You can't edite this card!");

        return view('cards.update', ['card' => $card]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['title' => 'required|string|max:40']);

        /* @var $user User */
        $user = auth()->user();

        $user->cards()->create(array_merge($validated, ['code' => microtime(true)]));

        return redirect()->route('cards.index');
    }

    public function update(Card $card, Request $request): RedirectResponse
    {
        $request->validate(['title' => 'string|max:40']);

        abort_if(
            $card->user_id != auth()->user()->id,
            403,
            "You can't edite this card!");

        $card->update($request->only(['title']));

        return redirect()->route('cards.index');
    }

    public function destroy(Card $card)
    {
        abort_if(
            $card->user_id != auth()->user()->id,
            403,
            "You can't delete this card!");

        $card->delete();

        return redirect()->route('cards.index');
    }
}
