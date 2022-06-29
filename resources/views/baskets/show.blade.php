@extends('layouts.app')
@section('content')
    <div class="w-full px-4 py-4 md:px-10 md:pt-6 lg:px-40 lg:pt-10">

        <div class="w-full md:flex justify-between">
            @include('baskets.basket')
        </div>

        <div class="mt-4">
            <div class="shadow rounded">@include('baskets.products')</div>
            <div class="shadow rounded">@include('baskets.games')</div>
        </div>
    </div>
@endsection
