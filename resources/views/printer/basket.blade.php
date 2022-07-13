<div class="w-full border border-gray-900 py-2">
    <div class="border-b border-gray-900 text-right px-4 flex">
        <div class="w-1/2">
            {{$basket->card->title}}
        </div>
        <div class="w-1/2">
            :کارت
        </div>
    </div>

    <div class="border-b border-gray-900 text-right px-4 flex">
        <div class="w-1/2">
            {{number_format($basketData->products,2)}}
        </div>
        <div class="w-1/2">
            :مصرفی
        </div>
    </div>


    <div class="border-b border-gray-900 text-right px-4 flex">
        <div class="w-1/2">
            {{number_format($basketData->games,2)}}
        </div>
        <div class="w-1/2">
            :بازی
        </div>
    </div>

    <div class="uppercase text-right px-4 flex">
        <div class="w-1/2">
            {{number_format($basketData->total,2)}}
        </div>
        <div class="w-1/2">
            :جمع
        </div>
    </div>
</div>
