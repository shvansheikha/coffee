@if(!$productOrders->isEmpty())
    <table class="w-full text-left cursor-pointer">
        <thead class="uppercase border-gray-900 border-b bg-gray-50">
        <tr>
            <th scope="col" class="font-medium px-2 py-1">
                Product
            </th>
            <th scope="col" class="font-medium px-2 py-1">
                Number
            </th>
            <th scope="col" class="font-medium px-2 py-1">
                Amount
            </th>
            <th scope="col" class="font-medium px-2 py-1">
                Price
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($productOrders as $order)

            @if($loop->last)
                <tr class="bg-white hover:bg-gray-50">
            @else
                <tr class="bg-white hover:bg-gray-50">
                    @endif
                    <th scope="row" class="px-2 py-1 font-medium">
                        {{$order->product->title}}({{$order->product->group->title}})
                    </th>
                    <td class="px-2 py-1">
                        {{$order->number}}
                    </td>
                    <td class="px-2 py-1">
                        {{$order->amount}}
                    </td>
                    <td class="px-2 py-1">
                        {{$order->price}}
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
@endif
