<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Filters\GroupFilters;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;


class GroupController extends Controller
{
    public function index(GroupFilters $filters): AnonymousResourceCollection
    {
        $groups = Group::orderByDesc('id')
            ->ofUser(auth()->user())
            ->filter($filters)
            ->get();

        return GroupResource::collection($groups);
    }

    public function show(GroupFilters $filters): Response
    {
        $groups = Group::orderByDesc('id')
            ->ofUser(auth()->user())
            ->filter($filters)
            ->get();

        $groups = groupResourceCollection($groups);

        return Inertia::render('Groups', ['groups' => $groups]);
    }

    public function store(StoreGroupRequest $request)
    {
        $validated = $request->validated();

        $validated['type'] = GroupType::getValue($validated['type']);

        Group::create(array_merge($validated, ['user_id' => auth()->id()]));

        return redirect('/groups');
    }

    public function update(Group $group, UpdateGroupRequest $request): Redirector|Application|RedirectResponse
    {
        $validated = $request->validated();
        $validated['type'] = GroupType::fromKey($validated['type'])->value;

        $group->update($validated);

        return redirect('/groups');
    }

    public function destroy(Group $group): Redirector|Application|RedirectResponse
    {
        $this->authorize('delete', $group);

        $group->delete();

        return redirect('/groups');
    }
}
