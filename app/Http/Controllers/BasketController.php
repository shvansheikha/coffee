<?php

namespace App\Http\Controllers;

use App\Filters\BasketFilters;
use App\Http\Requests\UpdateBasketRequest;
use App\Models\Basket;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class BasketController extends Controller
{
    public function index(BasketFilters $filters): Response
    {
        $baskets = Basket::with('card')
            ->ofUser(auth()->user())
            ->filter($filters)
            ->orderByDesc('closed_at')
            ->get();

        $baskets = basketResourceCollection($baskets);

        return Inertia::render('Baskets', ['baskets' => $baskets]);
    }

    public function show(Basket $basket): Response
    {
        $this->authorize('see', $basket);

        $games = Order::query()
            ->where('basket_id', $basket->id)
            ->withOrderable()
            ->ofUser(auth()->user())
            ->ownGame()
            ->orderByDesc('id')
            ->get();

        $products = Order::query()
            ->where('basket_id', $basket->id)
            ->withOrderable()
            ->ofUser(auth()->user())
            ->ownProduct()
            ->orderByDesc('id')
            ->get();

        $basket->products_price = $products->sum('price');
        $basket->games_price = $games->sum('price');
        $basket = basketResource($basket);
        $games = orderResourceCollection($games);
        $products = orderResourceCollection($products);

        return Inertia::render('BasketDetail', [
            'basket' => $basket,
            'gamesList' => $games,
            'productsList' => $products,
        ]);
    }

    public function update(UpdateBasketRequest $request, Basket $basket): Redirector|Application|RedirectResponse
    {
        $basket->update($request->validated());

        return redirect('/cards');
    }
}
