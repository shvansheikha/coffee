@extends('layouts.app')
@section('content')
    <div class="w-full px-40 pt-10">
        <div class="w-full flex justify-between">
            <div class="shadow rounded w-full">
                @include('order.product')
                @include('order.game')
            </div>

           @include('order.basket')
        </div>

        <div class="mt-4">
            <div class="shadow rounded">@include('order.products')</div>
            <div class="shadow rounded">@include('order.games')</div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#product-group').on('change', function () {
                var idGroup = this.value;
                $("#products").html('');
                $.ajax({
                    url: "{{url('api/fetch-products')}}",
                    type: "POST",
                    data: {
                        group_id: idGroup,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $.each(result.products, function (key, value) {
                            $("#products").append('<option value="' + value.id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
            $('#games-group').on('change', function () {
                var idGroup = this.value;
                $("#games").html('');
                $.ajax({
                    url: "{{url('api/fetch-games')}}",
                    type: "POST",
                    data: {
                        group_id: idGroup,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $.each(res.games, function (key, value) {
                            $("#games").append('<option value="' + value.id + '">' + value.title + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
