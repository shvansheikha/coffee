<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Filters\ProductFilters;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Group;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(ProductFilters $filters)
    {
        $products = Product::withGroup()
            ->orderByDesc('id')
            ->filter($filters)
            ->ofUser(auth()->user())
            ->get();

        return ProductResource::collection($products);
    }

    public function show(): Response
    {
        $products = Product::withGroup()
            ->orderByDesc('id')
            ->ofUser(auth()->user())
            ->get();

        $products = productResourceCollection($products);

        $groups = Group::orderByDesc('id')
            ->ofUser(auth()->user())
            ->type(GroupType::Product)
            ->get();

        $groups = groupResourceCollection($groups);

        return Inertia::render('Products', [
            'products' => $products,
            'groups' => $groups,
        ]);
    }

    public function store(StoreProductRequest $request): Redirector|Application|RedirectResponse
    {
        $exists = Group::query()
            ->where('id', $request->validated()['group_id'])
            ->ofUser(auth()->user())
            ->type(GroupType::Product)
            ->first();

        abort_unless(
            $exists,
            403,
            "Selected Group is not for you!");

        Product::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return redirect('/products');
    }

    public function update(Product $product, UpdateProductRequest $request): Redirector|Application|RedirectResponse
    {
        if ($request->validated()['group_id']) {
            $exists = Group::query()
                ->ofUser(auth()->user())
                ->where('id', $request->validated()['group_id'])
                ->type(GroupType::Product)
                ->exists();

            abort_unless($exists, 403, "Selected Group is not for you!");
        }

        $product->update($request->validated());

        return redirect('/products');
    }

    public function destroy(Product $product): Redirector|Application|RedirectResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return redirect('/products');
    }
}
