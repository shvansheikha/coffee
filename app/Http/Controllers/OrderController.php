<?php

namespace App\Http\Controllers;

use App\Filters\OrderFilters;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Basket;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    public function show($basketId): Response
    {
        $basket = Basket::find($basketId);

        $games = Order::query()
            ->where('basket_id', $basketId)
            ->withOrderable()
            ->ofUser(auth()->user())
            ->ownGame()
            ->orderByDesc('id')
            ->get();

        $products = Order::query()
            ->where('basket_id', $basketId)
            ->withOrderable()
            ->ofUser(auth()->user())
            ->ownProduct()
            ->orderByDesc('id')
            ->get();

        $basket->products_price = $products->sum('price') ?? 0;
        $basket->games_price = $games->sum('price') ?? 0;
        $basket = basketResource($basket);

        $games = orderResourceCollection($games);
        $products = orderResourceCollection($products);

        return Inertia::render('Order', [
            'basket' => $basket,
            'games' => $games,
            'products' => $products
        ]);
    }

    public function store(Basket $basket, StoreOrderRequest $request): Redirector|Application|RedirectResponse
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

        Order::create($attrs);

        return redirect()->route('orders.show', ['basket' => $basket->id]);
    }

    public function destroy(Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);

        $basketId = $order->basket_id;
        $order->delete();

        return redirect()->route('orders.show', ['basket' => $basketId]);
    }
}
