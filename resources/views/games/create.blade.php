<div>
    <form method="post" action="{{route('games.create')}}"
          class="flex items-center pb-4 mb-4 border-b">
        @csrf
        <input type="text"
               name="title"
               class="mr-4 form-control block w-1/4 px-3 py-1 hover:border-blue-600 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
               placeholder="Game Name">

        <select
            name="group_id"
            class="form-select appearance-none mr-4 form-control block w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
            @foreach($groups as $group)
                <option value="{{$group->id}}">{{$group->title}}</option>
            @endforeach
        </select>

        <input type="text"
               name="amount"
               class="mr-4 form-control block w-1/4 px-3 py-1 hover:border-blue-600 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
               placeholder="Amount Per Minute">

        <button type="submit"
                class="text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
            Create
        </button>
    </form>
</div>
