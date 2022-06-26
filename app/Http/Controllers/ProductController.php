<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
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

        $products = $user->products()->with('group')->orderByDesc('id')->get();

        $groups = $user->groups()->where('type', GroupType::Product)->get();

        return view('products.index', compact('products', 'groups'));
    }

    public function edite(Product $product): Factory|View|Application
    {
        /* @var $user User */
        $user = auth()->user();

        abort_if(
            $product->user_id != $user->id,
            403,
            "You can't edite this product!");

        $groups = $user->groups()->where('type', GroupType::Product)->get();

        $product->load('group');

        return view('products.update', compact('product', 'groups'));
    }

    public function store(Request $request)
    {
        // TODO should check group is of this user or not //
        $validated = $request->validate([
            'title' => 'required|string|max:40',
            'amount' => 'required|numeric|between:0,100000.99',
            'group_id' => 'required|exists:groups,id',
        ]);

        /* @var $user User */
        $user = auth()->user();

        $user->products()->create($validated);

        return redirect()->route('products.index');
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        // TODO should check group is of this user or not //
        $validated = $request->validate([
            'title' => 'string|max:40',
            'amount' => 'numeric|between:0,100000.99',
            'group_id' => 'required|exists:groups,id'
        ]);

        abort_if(
            $product->user_id != auth()->id(),
            403,
            "You can't edite this card!");

        $product->update($validated);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        abort_if(
            $product->user_id != auth()->id(),
            403,
            "You can't delete this card!");

        $product->delete();

        return redirect()->route('products.index');
    }
}
