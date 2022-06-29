@extends('layouts.app')

@section('content')

    <div class="w-full px-4 pt-6 md:px-40 md:pt-20">
        @foreach($data as $item)
            <a href="{{route('baskets.index', $item->date)}}">
                <div class="w-full md:flex border rounded my-2 py-2 px-6 justify-between cursor-pointer
            hover:border-blue-500 hover:text-blue-500">
                    <div>date: {{Verta::instance($item->date)->format('Y-m-d')}}</div>
                    <div>total: {{$item->total}}</div>
                    <div>total_price: {{$item->total_price}}</div>
                </div>
            </a>
        @endforeach
    </div>

@endsection
