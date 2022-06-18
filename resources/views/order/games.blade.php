@if(!$gameOrders->isEmpty())
    <table class="w-full text-sm text-left text-gray-500 cursor-pointer mt-4 rounded">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3">
                Game
            </th>
            <th scope="col" class="px-6 py-3">
                Person
            </th>
            <th scope="col" class="px-6 py-3">
                Amount
            </th>

            <th scope="col" class="px-6 py-3">
                Started At
            </th>

            <th scope="col" class="px-6 py-3">
                Stopped At
            </th>

            <th scope="col" class="px-6 py-3">
                Price
            </th>

            <th scope="col" class="px-6 py-3">
                Stop
            </th>

            <th scope="col" class="px-6 py-3">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($gameOrders as $order)

            @if($loop->last)
                <tr class="bg-white hover:bg-gray-50">
            @else
                <tr class="bg-white border-b hover:bg-gray-50">
                    @endif
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{$order->game->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$order->number}}
                    </td>
                    <td class="px-6 py-4">
                        {{$order->amount}}
                    </td>

                    <td class="px-6 py-4">
                        {{date('H:i:s', strtotime($order->started_at))}}
                    </td>

                    <td class="px-6 py-4">
                        {{date('H:i:s', strtotime($order->stopped_at))}}
                        ({{$order->diff}})
                    </td>

                    <td class="px-6 py-4">
                        {{$order->price}}
                    </td>

                    <td class="px-6 py-4">
                        <a href="{{ route('orders.stop', ['card'=> $card->id, 'order' => $order->id]) }}"
                           class="hover:text-blue-500">
                            <div class="uppercase">Stop</div>
                        </a>
                    </td>

                    <td class="px-6 py-4">
                        <a href="{{ route('orders.destroy', ['order' => $order->id]) }}"
                           class="hover:text-blue-500">
                            <div class="uppercase">Delete</div>
                        </a>
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
@endif
