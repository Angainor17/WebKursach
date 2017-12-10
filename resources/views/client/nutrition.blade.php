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

    <?php
    $var = date("l d.m.y");

    $tomorrow = mktime(0, 0, 0, date("m"), date("d") + 0, date("Y"));

    echo date('N', strtotime(date("l", $tomorrow)));
    ?>

@endsection