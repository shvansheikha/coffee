<div class="w-2/5 ml-5 shadow rounded p-4 flex flex-col">
    <div>
        <div><span>Card: </span><span> {{$card->title}} </span></div>
        <div><span>Product: </span><span> {{$basketData->products}} </span></div>
        <div><span>Game: </span><span> {{$basketData->games}} </span></div>
        <div class="text-blue-500 uppercase font-bold"><span>Total: </span><span> {{$basketData->total}} </span></div>
    </div>

    <div class="mt-auto mt-8">

        <a href="{{route('baskets.print', $basket)}}" target="_blank">
            <div
                class="text-center w-full mt-2 border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                Print
            </div>
        </a>

        <form method="post" action="{{route('baskets.update', ['card' => $card->id , 'basket' => $basket->id])}}"
              class="flex items-center">
            @csrf
            {{ method_field('PUT') }}

            <button type="submit"
                    class="text-center w-full mt-2 border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                Close
            </button>
        </form>
    </div>
</div>
