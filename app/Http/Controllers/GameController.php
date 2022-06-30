<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Models\Game;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(): JsonResponse
    {
        /* @var $user User */
        $user = auth()->user();

        $games = $user->games()->with(['group'])->orderByDesc('id')->get();

        return response()->json(['data' => $games]);
    }

    public function store(Request $request)
    {
        // TODO should check group is of this user or not //
        $validated = $request->validate([
            'title' => 'required|string|max:40',
            'amount' => 'required|numeric|between:0,100000',
            'group_id' => 'required|exists:groups,id'
        ]);

        /* @var $user User */
        $user = auth()->user();

        $user->games()->create($validated);

        return redirect()->route('games.index');
    }

    public function destroy(Game $game): RedirectResponse
    {
        abort_if(
            $game->user_id != auth()->user()->id,
            403,
            "You can't delete this game!");

        $game->delete();

        return redirect()->route('games.index');
    }

    public function edite(Game $game): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $game->user_id != $user->id,
            403,
            "You can't edite this game!");

        $groups = $user->groups()->where('type', GroupType::Game)->get();

        $game->load('group');

        return view('games.update', compact('game', 'groups'));
    }

    public function update(Game $game, Request $request): RedirectResponse
    {
        // TODO should check group is of this user or not //
        $validated = $request->validate([
            'title' => 'string|max:40',
            'amount' => 'numeric|between:0,100000',
            'group_id' => 'required|exists:groups,id'
        ]);

        abort_if(
            $game->user_id != auth()->id(),
            403,
            "You can't edite this game!");

        $game->update($validated);

        return redirect()->route('games.index');
    }
}
