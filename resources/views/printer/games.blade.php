@if(!$gameOrders->isEmpty())
    <table class="w-full text-right cursor-pointer">
        <thead class="bg-gray-50 border-gray-900 border-b">
        <tr>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                کل
            </th>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                فی
            </th>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                دقیقه
            </th>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                بازی
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($gameOrders as $order)

            <tr>
                <td class="px-2 py-1 text-xs">
                    {{number_format($order->price)}}
                </td>

                <td class="px-2 py-1 text-xs">
                    {{number_format ($order->amount)}}
                </td>

                <td class="px-2 py-1 text-xs">
                    @if(!empty($order->stopped_at))
                        {{$order->diff}}
                    @else
                        -
                    @endif
                </td>

                <th class="px-2 py-1 font-medium text-xs text-center">
                    {{$order->game->title}}
                </th>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif
