@extends('layouts.app')
@section('content')

    <div class="w-full overflow-x-auto p-20 px-40">
        <div class="shadow-md sm:rounded-lg">
            <div class="p-4 border-b">

                <div class="my-2">Create Group</div>
                @include('groups.create')
            </div>

            <table class="w-full text-sm text-left text-gray-500 cursor-pointer">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Type
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Edite
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Delete
                    </th>
                </tr>
                </thead>
                <tbody>

                @foreach($groups as $group)

                    @if($loop->last)
                        <tr class="bg-white hover:bg-gray-50">
                    @else
                        <tr class="bg-white border-b hover:bg-gray-50">
                            @endif
                            <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap">
                                {{$group->title}}
                            </th>
                            <td class="px-6 py-3">
                                {{$group->type->key}}
                            </td>

                            <td class="px-6 py-3">
                                <a href="{{ route('groups.edite', ['group' => $group->id]) }}"
                                   class="hover:text-blue-500 uppercase">
                                    <div>edite</div>
                                </a>
                            </td>

                            <td class="px-6 py-3">
                                <a href="{{ route('groups.destroy', ['group' => $group->id]) }}"
                                   class="hover:text-blue-500 uppercase">
                                    <div>Delete</div>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
