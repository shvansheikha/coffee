@extends('layouts.app')
@section('content')
    <div class="w-full p-4 overflow-x-auto p-10 px-40">
        <div class="shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 cursor-pointer">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Card
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Total Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Start
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Close
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Orders
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($baskets as $basket)

                    @if($loop->last)
                        <tr class="bg-white hover:bg-gray-50">
                    @else
                        <tr class="bg-white border-b hover:bg-gray-50">
                            @endif
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{($loop->index)+1}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{$basket->card->title}}
                            </th>

                            <td class="px-6 py-4">
                                {{$basket->total_price}}
                            </td>

                            <td class="px-6 py-4">
                                {{Verta::instance($basket->created_at)->format('H:i:s')}}
                            </td>

                            <td class="px-6 py-3">
                                {{Verta::instance($basket->closed_at)->format('H:i:s')}}
                            </td>

                            <td class="px-6 py-4">
                                <a href=""
                                   class="hover:text-blue-500">
                                    <div>Orders</div>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
