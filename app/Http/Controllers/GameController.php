<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Filters\GameFilters;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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

    public function store(StoreGameRequest $request): GameResource
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

        $game = Game::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return GameResource::make($game);
    }

    public function update(Game $game, UpdateGameRequest $request): GameResource
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

        return GameResource::make($game->fresh());
    }

    public function destroy(Game $game): JsonResponse
    {
        $this->authorize('delete', $game);

        $game->delete();

        return response()->json([], 204);
    }
}
