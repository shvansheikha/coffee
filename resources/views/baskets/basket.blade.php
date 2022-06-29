<div class="w-full shadow rounded p-4 md:flex justify-between">
    <div><span>Card: </span><span> {{$basket->card->title}} </span></div>
    <div><span>Product: </span><span> {{$basketData->products}} </span></div>
    <div><span>Game: </span><span> {{$basketData->games}} </span></div>
    <div class="text-blue-500 uppercase font-bold"><span>Total: </span><span> {{$basketData->total}} </span></div>
</div>
