<div>
    <form method="post" action="{{route('products.create')}}"
          class="flex items-center pb-4 mb-4 border-b">
        @csrf
        <input type="text"
               name="title"
               class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
               placeholder="Product Title">

        <input type="text"
               name="amount"
               class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
               placeholder="Product Amount">

        <button type="submit"
                class="w-52 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
            Create
        </button>
    </form>
</div>
