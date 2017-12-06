@extends("client.accountFrame", ["title"=>trans('app.ordersLabel')])

@section("innerContent")

    <script>
        $(document).ready(function () {
            menuActive();
        });

        function menuActive() {
            $('#orders').addClass("active");
        }

    </script>

    Orders

@endsection