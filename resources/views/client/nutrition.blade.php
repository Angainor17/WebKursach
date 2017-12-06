@extends("client.accountFrame", ["title"=>trans('app.app.nutritionStrategy')])

@section("innerContent")

    <script>
        $(document).ready(function () {
            menuActive();
        });

        function menuActive() {
            $('#nutritionStrategy').addClass("active");
        }

    </script>

    Nutrition Strategy

@endsection