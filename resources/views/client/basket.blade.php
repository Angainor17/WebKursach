@extends("layouts.app", ["title"=>trans('app.cartPage')])

@section("content")

    <script>
        $.ajax({
            url: "/basketProductList",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $("#text").innerHTML(data);
            }
        })
    </script>

    <div id="test"></div>

@endsection