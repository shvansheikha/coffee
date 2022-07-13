@extends('layouts.empty')

@section('content')
    <div class="w-full lg:w-1/3 text-gray-900 text-center mt-2">

        <div class="py-2 border border-gray-900 px-2">
            <div class="font-bold text-2xl">کافه گیم والا</div>
            <div class="text-right my-2 text-xs">
                <span>{{\Hekmatinasser\Verta\Verta::now()->format('Y/n/j H:i:s')}}</span>
                :تاریخ
            </div>
        </div>
        <div class="py-2 border border-gray-900 px-2 mt-1">

            <div class="mt-4">
                <div>@include('printer.products')</div>
                <div>@include('printer.games')</div>
            </div>
        </div>

        @include('printer.basket')
    </div>
@endsection
