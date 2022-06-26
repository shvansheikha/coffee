@if (Route::has('login'))
    <div class="">
        @auth

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2 flex items-center">
                <img class="rounded-full w-8" src="{{url('/img/default-avatar.jpg')}}">
                <span class="ml-2"> {{ Auth::user()->name }}</span>
            </div>

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a href="{{ url('/home') }}">
                    <div>Home</div>
                </a>
            </div>

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a href="{{ route("cards.index") }}">
                    <div>Cards</div>
                </a>
            </div>

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a href="{{ route('products.index') }}">
                    <div>Product</div>
                </a>
            </div>

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a href="{{ url('/games') }}">
                    <div class="w-full">Games</div>
                </a>
            </div>

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a href="{{ url('/groups') }}">
                    <div class="w-full">Groups</div>
                </a>
            </div>

            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a class="" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <div>Logout</div>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>


            </div>
        @else
            <div
                class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                <a href="{{ route('login') }}">Log in </a>
            </div>

            @if (Route::has('register'))
                <div
                    class="border border-transparent hover:border-blue-500 transition-all duration-300 fade cursor-pointer hover:text-blue-500 rounded px-4 py-1 mt-2">
                    <a href="{{ route('register') }}">Register </a>
                </div>
            @endif
        @endauth
    </div>
@endif
