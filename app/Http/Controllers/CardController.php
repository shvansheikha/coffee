<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCard;
use App\Http\Requests\UpdateCard;
use App\Http\Resources\CardResource;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CardController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        /* @var $user User */
        $user = auth()->user();

        $cards = Card::orderByDesc('id')->ofUser($user)->get();

        return CardResource::collection($cards);
    }

    public function store(StoreCard $request): CardResource
    {
        $card = Card::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return CardResource::make($card);
    }

    public function update(Card $card, UpdateCard $request): RedirectResponse
    {
        $card->update($request->validated());

        return redirect()->route('cards.index');
    }


    public function destroy(Card $card): JsonResponse
    {
        $this->authorize('delete', $card);

        $card->delete();

        return response()->json([], 204);
    }
}
