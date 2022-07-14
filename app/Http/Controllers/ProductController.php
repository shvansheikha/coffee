<?php

namespace App\Http\Controllers;

use App\Enums\GroupType;
use App\Filters\ProductFilters;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(ProductFilters $filters): AnonymousResourceCollection
    {
        $products = Product::withGroup()
            ->orderByDesc('id')
            ->filter($filters)
            ->ofUser(auth()->user())
            ->get();

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        // Check group is for this user
        $exists = Group::query()
            ->ofUser(auth()->user())
            ->where('id', $request->validated()['group_id'])
            ->type(GroupType::Product)
            ->exists();

        abort_unless(
            $exists,
            403,
            "Selected Group is not for you!");

        $product = Product::create(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return ProductResource::make($product);
    }

    public function update(Product $product, UpdateProductRequest $request): ProductResource
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

        return ProductResource::make($product->fresh());
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);

        $product->delete();

        return response()->json([], 204);
    }
}
