@if(!$gameOrders->isEmpty())
    <table class="w-full text-left cursor-pointer mt-4">
        <thead class="bg-gray-50 border-gray-900 border-b">
        <tr>
            <th class="font-medium px-2 py-1">
                Game
            </th>
            <th class="font-medium px-2 py-1">
                Amount
            </th>

            <th class="font-medium px-2 py-1">
                Start
            </th>

            <th class="font-medium px-2 py-1">
                Stop
            </th>

            <th class="font-medium px-2 py-1">
                Price
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($gameOrders as $order)

            @if($loop->last)
                <tr class="bg-white hover:bg-gray-50">
            @else
                <tr class="bg-white hover:bg-gray-50">
                    @endif
                    <th class="px-2 py-1 font-medium">
                        {{$order->game->title}} ({{$order->game->group->title}})
                    </th>
                    <td class="px-2 py-1">
                        {{$order->amount}}
                    </td>

                    <td class="px-2 py-1">
                        {{date('H:i:s', strtotime($order->started_at))}}
                    </td>

                    <td class="px-2 py-1">
                        @if(!empty($order->stopped_at))
                            {{date('H:i:s', strtotime($order->stopped_at))}}
                            ({{$order->diff}})
                        @else
                            -
                        @endif
                    </td>

                    <td class="px-2 py-1">
                        {{$order->price}}
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
@endif
