<div class="p-4">
    <div class="mb-2 pb-2 w-auto">Game</div>
    <form method="post" action="{{route('orders.game', $card->id)}}"
          class="flex items-center pb-2 mb-2">
        @csrf

        <select id="games-group"
                class="form-select appearance-none mr-4 form-control block w-full px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
            <option value="">Select Game</option>
            @foreach ($gameGroups as $group)
                <option value="{{$group->id}}">
                    {{$group->title}}
                </option>
            @endforeach
        </select>

        <select
            id="games"
            name="game"
            class="form-select appearance-none mr-4 form-control block w-full px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
        </select>

        <button type="submit"
                class="w-1/6 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
            Start
        </button>
    </form>
</div>
