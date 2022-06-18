@extends('layouts.app')
@section('content')
    <div class="p-20">
        <div class="shadow p-4 rounded">
            <form method="post" action="{{route('products.update', $product)}}"
                  class="flex items-center pb-4 mb-4">
                @csrf
                {{ method_field('PUT') }}
                <input type="text"
                       name="title"
                       value="{{$product->title}}"
                       class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Title">

                <input type="text"
                       name="amount"
                       value="{{$product->amount}}"
                       class="mr-4 form-control block w-80 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Product Amount">

                <button type="submit"
                        class="w-52 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
