<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CardController extends Controller
{
    public function index(): AnonymousResourceCollection
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

        return CardResource::collection($cards);
    }

    public function store(StoreCard $request): CardResource
    {
        $card = Card::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return CardResource::make($card);
    }

    public function update(Card $card, UpdateCardRequest $request): CardResource
    {
        $card->update($request->validated());

        return CardResource::make($card->fresh());
    }

    public function destroy(Card $card): JsonResponse
    {
        $this->authorize('delete', $card);

        $card->delete();

        return response()->json([], 204);
    }
}
