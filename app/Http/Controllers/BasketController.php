<?php

namespace App\Http\Controllers;

use App\Filters\BasketFilters;
use App\Http\Requests\UpdateBasketRequest;
use App\Http\Resources\BasketResource;
use App\Models\Basket;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function index(BasketFilters $filters): AnonymousResourceCollection
    {
        $baskets = Basket::with('card')
            ->ofUser(auth()->user())
            ->filter($filters)
            ->orderByDesc('closed_at')
            ->get();

        return BasketResource::collection($baskets);
    }

    public function show(Basket $basket): BasketResource
    {
        $this->authorize('see', $basket);

        $orderTotalPrice = Order::query()
            ->select(DB::raw("SUM(price) as total_price, orderable_type"))
            ->ofUser(auth()->user())
            ->ofBasket($basket)
            ->groupBy('orderable_type')
            ->get();

        $product = $orderTotalPrice->where('orderable_type', get_class(new Product))->first();
        $game = $orderTotalPrice->where('orderable_type', get_class(new Game))->first();

        $basket->products_price = $product->total_price ?? 0;
        $basket->games_price = $game->total_price ?? 0;

        return BasketResource::make($basket);
    }

    public function update(Basket $basket, UpdateBasketRequest $request): BasketResource
    {
        $basket->update($request->validated());

        return BasketResource::make($basket->fresh());
    }
}
