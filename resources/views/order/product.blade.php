<div class="p-4">
    <div class="mb-2 pb-2 w-auto">Order</div>
    <form method="post" action="{{route('orders.create', $card->id)}}"
          class="flex items-center pb-4 border-b">
        @csrf

        <select id="product-group"
                class="form-select appearance-none mr-4 form-control block w-full px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
            <option value="">Select Product</option>
            @foreach ($productGroups as $group)
                <option value="{{$group->id}}">
                    {{$group->title}}
                </option>
            @endforeach
        </select>

        <select
            id="products"
            name="product"
            class="form-select appearance-none mr-4 form-control block w-full px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
        </select>

        <input type="text"
               name="number"
               value="1"
               class="mr-4 form-control block w-2/6 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none"
               placeholder="Number">

        <button type="submit"
                class="w-1/6 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
            Order
        </button>
    </form>
</div>
