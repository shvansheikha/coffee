@extends('layouts.app')
@section('content')

    <div class="w-2/3 sm:w-full p-4 overflow-x-auto md:px-20 md:py-10">
        <div class="shadow-md sm:rounded-lg">
            <div class="p-4">

                <div class="my-2">Create Card</div>
                @include('cards.create')
            </div>

            <table class="w-full text-sm text-left text-gray-500 cursor-pointer">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Order
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Edite
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($cards as $card)

                    @if($loop->last)
                        <tr class="bg-white hover:bg-gray-50">
                    @else
                        <tr class="bg-white border-b hover:bg-gray-50">
                            @endif
                            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{$card->title}}
                            </th>
                            <td class="px-6 py-3">
                                <a href="{{ route('orders.index', ['card' => $card->id]) }}"
                                   class="font-medium text-blue-600 hover:underline">
                                    Order
                                </a>
                            </td>

                            <td class="px-6 py-3">
                                <a href="{{ route('cards.edite', ['card' => $card->id]) }}"
                                   class="hover:text-blue-500 uppercase">
                                    <div>edite</div>
                                </a>
                            </td>

                            <td class="px-6 py-3">
                                <a href="{{ route('cards.destroy', ['card' => $card->id]) }}"
                                   class="hover:text-blue-500 uppercase">
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
