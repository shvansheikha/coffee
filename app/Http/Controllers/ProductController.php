<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        /* @var $user User */
        $user = auth()->user();

        $products = $user->products;

        return view('products.index', ['products' => $products]);
    }

    public function edite(Product $product): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $product->user_id != auth()->user()->id,
            403,
            "You can't edite this product!");

        return view('products.update', ['product' => $product]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:40',
            'amount' => 'required|numeric|between:0,100000.99',
        ]);

        /* @var $user User */
        $user = auth()->user();

        $user->products()->create($validated);

        return redirect()->route('products.index');
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:40',
            'amount' => 'numeric|between:0,100000.99',
        ]);

        abort_if(
            $product->user_id != auth()->user()->id,
            403,
            "You can't edite this card!");

        $product->update($request->only(['title', 'amount']));

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        abort_if(
            $product->user_id != auth()->user()->id,
            403,
            "You can't delete this card!");

        $product->delete();

        return redirect()->route('products.index');
    }
}
