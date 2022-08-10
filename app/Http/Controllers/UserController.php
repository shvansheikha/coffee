<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request): UserResource
    {
        $user = auth()->user();

        $user->update($request->validated());

        return UserResource::make($user->fresh());
    }
}
