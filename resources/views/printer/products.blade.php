@if(!$productOrders->isEmpty())
    <table class="w-full text-right cursor-pointer mb-4">
        <thead class="uppercase border-gray-900 border-b bg-gray-50">
        <tr>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                کل
            </th>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                فی
            </th>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                تعداد
            </th>

            <th scope="col" class="text-xs font-bold px-2 py-1">
                شرح
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($productOrders as $order)

            <tr>
                <td class="px-2 py-1 text-xs">
                    {{number_format($order->price)}}
                </td>

                <td class="px-2 py-1 text-xs">
                    {{number_format($order->amount)}}
                </td>

                <td class="px-2 py-1 text-xs">
                    {{$order->number}}
                </td>

                <th scope="row" class="px-2 py-1 font-medium text-xs">
                    <span>{{$order->product->title}}</span>
                </th>
            </tr>
        @endforeach

        </tbody>
    </table>
@endif
