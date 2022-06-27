@extends('layouts.app')
@section('content')
    <div class="w-full px-40 pt-10">
        <div class="mt-4">
            <div class="shadow rounded">@include('order.products')</div>
            <div class="shadow rounded">@include('order.games')</div>
        </div>
    </div>
@endsection
