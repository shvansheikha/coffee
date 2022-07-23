<?php

namespace App\Http\Controllers;

use App\Filters\OrderFilters;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Basket;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    public function index(OrderFilters $filters): AnonymousResourceCollection
    {
        $orders = Order::query()
            ->withOrderable()
            ->ofUser(auth()->user())
            ->filter($filters)
            ->orderByDesc('id')
            ->get();

        return OrderResource::collection($orders);
    }

    public function store(Basket $basket, StoreOrderRequest $request): OrderResource
    {
        $validated = $request->validated();

        $attrs = [
            'user_id' => auth()->id(),
            'card_id' => $basket->card_id,
            'basket_id' => $basket->id,
            'orderable_id' => $validated['orderable'],
            'orderable_type' => $validated['type'] == "game" ? get_class(new Game) : get_class(new Product),
            'number' => $validated['number'] ?? null,
        ];

        $order = Order::create($attrs);

        return OrderResource::make($order);
    }

    public function destroy(Order $order): JsonResponse
    {
        $this->authorize('delete', $order);

        $order->delete();

        return response()->json([], 204);
    }
}
