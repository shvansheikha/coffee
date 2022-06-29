@extends('layouts.empty')

@section('content')
    <div class="w-full lg:w-1/3 text-xs text-gray-900">

        @include('printer.basket')

        <div class="mt-4">
            <div>@include('printer.products')</div>
            <div class="mt-8">@include('printer.games')</div>
        </div>
    </div>
@endsection
