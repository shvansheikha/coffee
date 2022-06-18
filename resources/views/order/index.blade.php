@extends('layouts.app')
@section('content')

    <div class="w-full px-40 pt-10">
       <div class="w-full flex justify-between">
           <div class="shadow rounded w-full">
               @include('order.product')
               @include('order.game')
           </div>

           <div class="shadow rounded w-2/5 ml-5 p-4 items-center">
                <div><span>Card: </span><span> {{$card->title}} </span></div>
                <div><span>Product: </span><span> 86000.300 </span></div>
                <div><span>Game: </span><span> 60000 </span></div>
                <div class="text-blue-500 uppercase font-bold"><span>Total: </span><span> 140000.300 </span></div>
           </div>
       </div>

        <div class="mt-4">
            <div class="shadow rounded">@include('order.products')</div>
            <div class="shadow rounded">@include('order.games')</div>
        </div>
    </div>
@endsection
