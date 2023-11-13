<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Filters\GameFilters;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Basket;
use App\Models\Card;
use App\Models\Game;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class GameController extends Controller
{
    public function index(GameFilters $filters): AnonymousResourceCollection
    {
        $games = Game::orderByDesc('id')
            ->filter($filters)
            ->ofUser(auth()->user())
            ->get();

        return GameResource::collection($games);
    }

    public function show(): Response
    {
        $games = Game::orderByDesc('id')
            ->ofUser(auth()->user())
            ->get();

        $games = gameResourceCollection($games);

        $groups = Group::orderByDesc('id')
            ->ofUser(auth()->user())
            ->where('type', 'game')
            ->get();

        $groups = groupResourceCollection($groups);

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

        return Inertia::render('Games', [
            'games' => $games,
            'groups' => $groups,
            'cards' => $cards,
        ]);
    }

    public function store(StoreGameRequest $request): Redirector|Application|RedirectResponse
    {
        $exists = Group::query()
            ->ofUser(auth()->user())
            ->where('id', $request->validated()['group_id'])
            ->type(GroupType::Game)
            ->exists();

        abort_unless(
            $exists,
            403,
            "Selected Group is not for you!");

        Game::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return redirect('/games');
    }

    public function update(Game $game, UpdateGameRequest $request): Redirector|Application|RedirectResponse
    {
        if ($request->validated()['group_id']) {
            $exists = Group::query()
                ->ofUser(auth()->user())
                ->where('id', $request->validated()['group_id'])
                ->type(GroupType::Game)
                ->exists();

            abort_unless($exists, 403, "Selected Group is not for you!");
        }

        $game->update($request->validated());

        return redirect('/games');
    }

    public function startGame(Game $game, Request $request): Redirector|Application|RedirectResponse
    {
        $game->update(['open' => true, 'started_at' => now()]);

        return redirect('/games');
    }

    public function stopGame(Game $game, $basket, Request $request): Redirector|Application|RedirectResponse
    {
        $basket = Basket::findOrFail($basket);

        $from = $game->started_at;
        $to = now();
        $diff = $to->diffInMinutes($from);
        $price = round($diff * $game->amount);

        $attr = [
            'user_id' => auth()->id(),
            'card_id' => $basket->card_id,
            'basket_id' => $basket->id,
            'orderable_id' => $game->id,
            'orderable_type' => get_class(new Game),
            'started_at' => $from,
            'stopped_at' => $to,
            'price' => $price,
        ];

        Order::query()->create($attr);

        $game->update(['open' => false, 'started_at' => null]);

        return redirect('/games');
    }

    public function destroy(Game $game): Redirector|Application|RedirectResponse
    {
        $this->authorize('delete', $game);

        $game->delete();

        return redirect('/games');
    }
}
