@extends('layouts.app')
@section('content')

    <div class="w-full p-4 overflow-x-auto p-20">
        <div class="shadow-md sm:rounded-lg">
            <div class="p-4">

                <div class="my-2">Create Game</div>
                @include('products.create')
            </div>
            <table class="w-full text-sm text-left text-gray-500 cursor-pointer">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Amount
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span>Edit</span>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $product)

                    @if($loop->last)
                        <tr class="bg-white hover:bg-gray-50">
                    @else
                        <tr class="bg-white border-b hover:bg-gray-50">
                            @endif
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$product->title}}
                            </th>
                            <td class="px-6 py-4">
                                {{$product->amount}}
                            </td>
                            <td class="px-6 py-4">
                                Laptop
                            </td>

                            <td class="px-6 py-3">
                                <a href="{{ route('products.edite', ['product' => $product->id]) }}"
                                   class="hover:text-blue-500 uppercase">
                                    <div>edite</div>
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <a href="{{ route('products.destroy', ['product' => $product->id]) }}"
                                   class="hover:text-blue-500">
                                    <div>Delete</div>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
