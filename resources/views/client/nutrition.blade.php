@extends("client.accountFrame", ["title"=>trans('app.nutritionStrategy')])

@section("innerContent")

    <script>
        $(document).ready(function () {
            menuActive();
        });

        function menuActive() {
            $('#nutritionStrategy').addClass("active");
        }

    </script>

    {{$dump}}

@endsection