<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Models\Basket;
use App\Models\Card;
use App\Models\Game;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use stdClass;

class OrderController extends Controller
{
    public function show(Card $card): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $card->user_id != $user->id,
            403,
            "You can't delete this card!");

        $productGroups = $user->groups()->where('type', GroupType::Product)->get();

        $gameGroups = $user->groups()->where('type', GroupType::Game)->get();

        $basket = $card->baskets()->firstOrCreate(['user_id' => $user->id, 'closed' => false]);

        list($productOrders, $gameOrders) = $this->getOrders($basket);

        $basketData = $this->getBasketData($productOrders, $gameOrders);

        return view('order.index',
            compact(
                'card',
                'productGroups',
                'gameGroups',
                'productOrders',
                'gameOrders',
                'basket',
                'basketData'
            ));
    }

    public function store(Card $card, Request $request)
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $card->user_id != $user->id,
            403,
            "You can't delete this card!");

        $validated = $request->validate([
            'product' => 'required|exists:products,id',
            'number' => 'required|int|max:100',
        ]);

        $product = $user->products()->find($validated['product']);

        abort_unless(
            $product,
            403,
            "You can't order this product!");

        $basket = $card->baskets()
            ->firstOrCreate([
                'user_id' => $user->id,
                'closed' => false
            ]);

        $attrs = [
            'card_id' => $card->id,
            'basket_id' => $basket->id,
            'orderable_id' => $product->id,
            'orderable_type' => get_class($product),
            'number' => $validated['number'],
            'amount' => $product->amount,
            'price' => ($product->amount * $validated['number'])
        ];

        $user->orders()->create($attrs);

        return redirect()->route('orders.index', $card);
    }

    public function game(Card $card, Request $request): RedirectResponse
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $card->user_id != $user->id,
            403,
            "You can't order something for this card!");

        $validated = $request->validate(['game' => 'required|exists:games,id']);

        $game = $user->games()->find($validated['game']);

        abort_unless(
            $game,
            403,
            "You can't start this game!");

        $basket = $card->baskets()
            ->firstOrCreate([
                'user_id' => $user->id,
                'closed' => false
            ]);

        $attrs = [
            'card_id' => $card->id,
            'basket_id' => $basket->id,
            'orderable_id' => $game->id,
            'orderable_type' => get_class($game),
            'amount' => $game->amount,
            'started_at' => now()
        ];

        $user->orders()->create($attrs);

        return redirect()->route('orders.index', $card);
    }

    public function stop(Card $card, Order $order)
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            ($this->userCanNotUpdateCardAndOrder($card, $user, $order) || $this->isNotGame($order)),
            403,
            "You can't stop this game!");

        $order->stopped_at = now();

        $from = $order->started_at;
        $to = $order->stopped_at;
        $diff = $to->diffInMinutes($from);
        $order->price = $diff * $order->amount;
        $order->save();

        return redirect()->route('orders.index', $card);
    }

    public function destroy(Order $order): RedirectResponse
    {
        abort_if(
            $order->user_id != auth()->user()->id,
            403,
            "You can't delete this card!");

        $card = $order->card_id;
        $order->delete();

        return redirect()->route('orders.index', $card);
    }

    public function isNotGame(Order $order): bool
    {
        return $order->orderable_type != get_class(new Game()) || !empty($order->stopped_at);
    }

    public function userCanNotUpdateCardAndOrder(Card $card, User $user, Order $order): bool
    {
        return $card->user_id != $user->id || $card->id != $order->card_id;
    }

    public function fetchProducts(Request $request)
    {
        $data['products'] = auth()->user()->products()->where("group_id", $request->group_id)->get(["title", "id"]);
        return response()->json($data);
    }

    public function fetchGames(Request $request)
    {
        $data['games'] = auth()->user()->games()->where("group_id", $request->group_id)->get(["title", "id"]);
        return response()->json($data);
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

    public function getBasketData($productOrders, $gameOrders)
    {
        $basketData = new stdClass();
        $basketData->products = $productOrders->sum('price');
        $basketData->games = $gameOrders->sum('price');
        $basketData->total = $productOrders->sum('price') + $gameOrders->sum('price');

        return $basketData;
    }
}
