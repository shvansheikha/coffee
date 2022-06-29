@if(!$gameOrders->isEmpty())
    <table class="w-full text-sm text-left text-gray-500 cursor-pointer mt-4 rounded">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 text-xs  py-3">
                Game
            </th>
            <th scope="col" class="px-2 text-xs  py-3">
                Amount
            </th>

            <th scope="col" class="px-2 text-xs  py-3">
                Started At
            </th>

            <th scope="col" class="px-2 text-xs  py-3">
                Stopped At
            </th>

            <th scope="col" class="px-2 text-xs  py-3">
                Price
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
                    <th scope="row" class="px-6 text-xs py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{$order->game->title}} <span class="text-xs">({{$order->game->group->title}})</span>
                    </th>
                    <td class="px-2 text-xs py-4">
                        {{$order->amount}}
                    </td>

                    <td class="px-2 text-xs py-4">
                        {{date('H:i:s', strtotime($order->started_at))}}
                    </td>

                    <td class="px-2 text-xs py-4">
                        @if(!empty($order->stopped_at))
                            {{date('H:i:s', strtotime($order->stopped_at))}}
                            ({{$order->diff}})
                        @endif
                    </td>

                    <td class="px-2 text-xs py-4">
                        {{$order->price}}
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
@endif
