<?php

use Carbon\Carbon;

function userResource($item): array
{
    return [
        'id' => $item->id,
        'name' => $item->name,
        'email' => $item->email,
        'email_verified_at' => $item->email_verified_at,
        'coffee_title' => $item->coffee_title,
        'created_at' => $item->created_at->format('H:i:s'),
        'updated_at' => $item->updated_at->format('Y-m-d H:i:s')
    ];
}

function basketResource($item): array
{
    return [
        'id' => $item->id,
        'user_id' => $item->id,
        'card_title' => $item->card->title,
        'products_price' => round($item->products_price, 2) ?? null,
        'games_price' => round($item->games_price, 2) ?? null,
        'total_price' => $item->total_price,
        'price' => $item->total_price,
        'closed_at' => !empty($item->closed_at) ? Carbon::parse($item->closed_at)->format('H:i:s') : null,
        'created_at' => $item->created_at->format('H:i:s'),
        'updated_at' => $item->updated_at->format('Y-m-d H:i:s')
    ];
}

function basketResourceCollection($items)
{
    return $items->map(function ($item) {
        return basketResource($item);
    });
}

function cardResourceCollection($items)
{
    return $items->map(function ($item) {
        return cardResource($item);
    });
}

function cardResource($item): array
{
    return [
        'id' => $item->id,
        'user_id' => $item->user_id,
        'title' => $item->title,
        'basket' => isset($item->lastBasket) ? basketResource($item->lastBasket) : null,
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at
    ];
}

function orderResourceCollection($items)
{
    return $items->map(function ($item) {
        return orderResource($item);
    });
}

function orderResource($item): array
{
    return [
        'id' => $item->id,
        'orderable_title' => $item->orderable->title,
        'orderable_group_title' => $item->orderable->group->title,
        'number' => $item->number,
        'amount' => $item->amount,
        'started_at' => !empty($item->started_at) ? Carbon::parse($item->started_at)->format('H:i:s') : null,
        'stopped_at' => !empty($item->stopped_at) ? Carbon::parse($item->stopped_at)->format('H:i:s') : null,
        'price' => $item->price,
        'diff' => $item->diff,
        'created_at' => $item->created_at->format('Y-m-d H:i:s'),
        'updated_at' => $item->updated_at->format('Y-m-d H:i:s')
    ];
}

function groupResource($item): array
{
    return [
        'id' => $item->id,
        'user_id' => $item->user_id,
        'title' => $item->title,
        'type' => $item->type->key,
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at,
    ];
}

function groupResourceCollection($items)
{
    return $items->map(function ($item) {
        return groupResource($item);
    });
}

function gameResourceCollection($items)
{
    return $items->map(function ($item) {
        return gameResource($item);
    });
}

function gameResource($item): array
{
    return [
        'id' => $item->id,
        'user_id' => $item->user_id,
        'group_id' => $item->group_id,
        'title' => $item->title,
        'group' => $item->group->title,
        'amount' => round($item->amount, 2),
        'open' => $item->open,
        'started_at_mapped' => !empty($item->started_at) ? Carbon::parse($item->started_at)->format('H:i:s') : null,
        'started_at' => $item->started_at,
        'closed_at' => !empty($item->closed_at) ? Carbon::parse($item->closed_at)->format('H:i:s') : null,
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at,
    ];
}

function productResourceCollection($items)
{
    return $items->map(function ($item) {
        return productResource($item);
    });
}

function productResource($item): array
{
    return [
        'id' => $item->id,
        'user_id' => $item->user_id,
        'group_id' => $item->group_id,
        'title' => $item->title,
        'group' => $item->group->title,
        'amount' => round($item->amount, 2),
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at
    ];
}
