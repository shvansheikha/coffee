<form method="post" action="{{route('groups.create')}}"
      class="flex items-center pb-4 mb-4 border-b">
    @csrf
    <input type="text"
           name="title"
           class="mr-4 form-control block w-2/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none"
           placeholder="Enter Title">

    <select
        name="type"
        class="form-select appearance-none mr-4 form-control block w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
        <option value="Product">Product</option>
        <option value="Game">Game</option>
    </select>

    <button type="submit"
            class="w-1/4 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
        Create
    </button>
</form>
