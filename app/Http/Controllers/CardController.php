<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class CardController extends Controller
{
    public function index(): Response
    {
        $cards = Card::orderByDesc('id')
            ->ofUser(auth()->user())
            ->get();

        $cards->each(function ($card) {
            $basket = $card->baskets()
                ->firstOrCreate([
                    'user_id' => auth()->id(),
                    'closed' => false
                ]);
            $card->lastBasket = $basket;
        });

        $cards = cardResourceCollection($cards);

        return Inertia::render('Cards', ['cards' => $cards]);
    }

    public function store(StoreCardRequest $request): Redirector|Application|RedirectResponse
    {
        Card::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return redirect('/cards');
    }

    public function update(Card $card, UpdateCardRequest $request): Redirector|Application|RedirectResponse
    {
        $card->update($request->validated());

        return redirect('/cards');
    }

    public function destroy(Card $card): Redirector|Application|RedirectResponse
    {
        $this->authorize('delete', $card);

        $card->delete();

        return redirect('/cards');
    }
}
