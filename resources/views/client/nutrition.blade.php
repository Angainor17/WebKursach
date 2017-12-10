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

    <script type="text/x-kendo-template" id="template">
        <div class="product">

            <p></p>

        </div>
    </script>


    {{$dump}}

@endsection