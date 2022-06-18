<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="text-gray-300 h-screen w-full flex items-center justify-center font-mono antialiased bg-gray-600">

<div>
    <div>
        <span>404 error</span>
        <span>page not found</span>
    </div>
    <div>
        <span>sorry about that!</span>
        <span class="hover:text-blue-500"><a href="{{route('home')}}"><b>return home?</b></a></span>
    </div>
</div>


<script src="https://use.typekit.net/lkh0ago.js"></script>

</body>
</html>


