<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Filters\GroupFilters;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


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

    public function store(StoreGroupRequest $request): GroupResource
    {
        $validated = $request->validated();

        $validated['type'] = GroupType::getValue($validated['type']);

        $group = Group::create(array_merge($validated, ['user_id' => auth()->id()]));

        return GroupResource::make($group);
    }

    public function update(Group $group, UpdateGroupRequest $request): GroupResource
    {
        $validated = $request->validated();
        $validated['type'] = GroupType::fromKey($validated['type'])->value;

        $group->update($validated);

        return GroupResource::make($group->fresh());
    }

    public function destroy(Group $group): JsonResponse
    {
        $this->authorize('delete', $group);

        $group->delete();

        return response()->json([], 204);
    }
}
