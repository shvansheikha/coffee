<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Models\Card;
use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use BenSampo\Enum\Rules\EnumKey;


class GroupController extends Controller
{
    public function index(): JsonResponse
    {
        /* @var $user User */
        $user = auth()->user();

        $groups = $user->groups;

        return response()->json(['data' => $groups]);
    }

    public function edite(Group $group): Factory|View|Application
    {
        abort_if(
            $group->user_id != auth()->user()->id,
            403,
            "You can't edite this group!");

        return view('groups.update', compact('group'));
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:40',
            'type' => ['required', new EnumKey(GroupType::class)],
        ]);

        /* @var $user User */
        $user = auth()->user();

        $validated['type'] = GroupType::getValue($validated['type']);

        $user->groups()->create($validated);

        return redirect()->route('groups.index');
    }

    public function update(Group $group, Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:40',
            'type' => [new EnumKey(GroupType::class)],
        ]);

        abort_if(
            $group->user_id != auth()->id(),
            403,
            "You can't edite this group!");

        $validated['type'] = GroupType::getValue($validated['type']);

        $group->update($validated);

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        abort_if(
            $group->user_id != auth()->user()->id,
            403,
            "You can't delete this group!");

        $group->delete();

        return redirect()->route('groups.index');
    }
}
