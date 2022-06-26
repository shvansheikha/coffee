@extends('layouts.app')
@section('content')
    <div class="p-20">
        <div class="shadow p-4 rounded">
            <form method="post" action="{{route('groups.update', $group->id)}}"
                  class="flex items-center pb-4">
                @csrf
                {{ method_field('PUT') }}
                <input type="text"
                       name="title"
                       value="{{$group->title}}"
                       class="mr-4 form-control block w-2/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       placeholder="Enter Title">

                <select
                    name="type"
                    class="form-select appearance-none mr-4 form-control block w-1/4 px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white hover:border-blue-600 focus:border-blue-600 focus:outline-none">
                    <option value="Product" @if($group->type->key === 'Product')  selected @endif >Product</option>
                    <option value="Game" @if($group->type->key === 'Game')  selected @endif >Game</option>
                </select>

                <button type="submit"
                        class="w-52 text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
