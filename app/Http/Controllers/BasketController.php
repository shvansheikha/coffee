<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Card;
use App\Models\Game;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use stdClass;

class BasketController extends Controller
{

    public function index($date): Factory|View|Application
    {
        $baskets = Basket::with(['card', 'orders'])
            ->where("user_id", auth()->id())
            ->whereDate('created_at', '=', $date)
            ->latest()
            ->get();

        return view('baskets.index', compact('baskets'));
    }

    public function show(Basket $basket): Factory|View|Application
    {
        abort_if(
            $basket->user_id != auth()->id(),
            403,
            "You can't see this basket!");

        list($productOrders, $gameOrders) = $this->getOrders($basket);

        $basketData = $this->getBasketData($productOrders, $gameOrders);

        return view('baskets.show', compact('productOrders', 'gameOrders', 'basketData'));
    }

    public function update(Card $card, Basket $basket): RedirectResponse
    {
        abort_if(
            $card->user_id != auth()->id(),
            403,
            "You can't close this basket!");

        list($productOrders, $gameOrders) = $this->getOrders($basket);

        $totalPrice = $productOrders->sum('price') + $gameOrders->sum('price');

        $basket->update([
            'closed' => true,
            'total_price' => $totalPrice,
            'closed_at' => now()
        ]);

        return redirect()->route("cards.index");
    }

    public function getOrders(Basket $basket): array
    {
        $productOrders = $basket->orders()
            ->with(['product' => function ($q) {
                $q->withTrashed();
            }, 'product.group'])
            ->whereHasMorph('orderable', [Product::class])
            ->orderByDesc('id')
            ->get();

        $gameOrders = $basket->orders()
            ->with(['game' => function ($q) {
                $q->withTrashed();
            }, 'game.group'])
            ->whereHasMorph('orderable', [Game::class])
            ->orderByDesc('id')
            ->get();

        $gameOrders = $gameOrders->each(function ($order) {
            if (!empty($order->stopped_at)) {
                $from = Carbon::parse($order->started_at);
                $to = Carbon::parse($order->stopped_at);
                $diff_date = $to->diff($from);
                $diff = "";
                if ($diff_date->h > 0) {
                    $diff .= $diff_date->h . ":";
                }
                $diff .= $diff_date->i . ":" . $diff_date->s;
                $order->diff = $diff;
            }
        });
        return array($productOrders, $gameOrders);
    }

    public function getBasketData($productOrders, $gameOrders): stdClass
    {
        $basketData = new stdClass();
        $basketData->products = $productOrders->sum('price');
        $basketData->games = $gameOrders->sum('price');
        $basketData->total = $productOrders->sum('price') + $gameOrders->sum('price');

        return $basketData;
    }
}
