@if(!$productOrders->isEmpty())
    <table class="w-full text-sm text-left text-gray-500 cursor-pointer rounded">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="px-6 text-xs py-3">
                Product
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Number
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Amount
            </th>
            <th scope="col" class="px-2 text-xs py-3">
                Price
            </th>

            <th scope="col" class="px-2 text-xs py-3">
                Delete
            </th>
        </tr>
        </thead>
        <tbody>

        @foreach($productOrders as $order)

            @if($loop->last)
                <tr class="bg-white hover:bg-gray-50">
            @else
                <tr class="bg-white border-b hover:bg-gray-50">
                    @endif
                    <th scope="row" class="px-6 text-xs py-3 font-medium text-gray-900 whitespace-nowrap">
                        {{$order->product->title}} <span class="text-xs">({{$order->product->group->title}})</span>
                    </th>
                    <td class="px-2 text-xs py-3">
                        {{$order->number}}
                    </td>
                    <td class="px-2 text-xs py-3">
                        {{$order->amount}}
                    </td>
                    <td class="px-2 text-xs py-3">
                        {{$order->price}}
                    </td>

                    <td class="px-2 text-xs py-3">
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
