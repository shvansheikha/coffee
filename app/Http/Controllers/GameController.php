<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        $games = $user->games;

        return view('games.index', ['games' => $games]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:40',
            'amount' => 'required|numeric|between:0,100000.99',
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
}
