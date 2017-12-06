@extends("client.accountFrame", ["title"=>trans('app.ordersLabel')])

@section("innerContent")

    <style>

        #listView {
            padding-left: 3%;
            padding-right: 3%;
            margin-left: 6%;
            padding-top: 50px;
            margin-right: 6%;
            display: block;
            text-align: center;
        }

        .order {
            border: 2px solid #b9b9b9;
            width: 60%;
            height: 100px;
            margin: 20px;
            font-size: 16px;
            padding: 20px;
            text-align: left;
        }
    </style>

    <div>
        <div id="listView"></div>
    </div>

    <script>
        $(document).ready(function () {
            menuActive();
        });

        function menuActive() {
            $('#orders').addClass("active");
        }

        $(function () {
            var dataSource = new kendo.data.DataSource({
                transport: {
                    read: {
                        url: "orderslist",
                        dataType: "json"
                    }
                }
            });

            $("#listView").kendoListView({
                dataSource: dataSource,
                template: kendo.template($("#template").html())
            });

        })

    </script>

    <script type="text/x-kendo-template" id="template">
        <div class="order">
            <p>Name: #:name#</p>
            <p>Cost: #:cost#</p>
            <p>Date: #:date#</p>

            {{--<div class="imageDiv">--}}
                {{--<a href="/product/#:id#"><img class="card-img-top" src="{{asset('/uploads/')}}/#:imageId#"--}}
                                              {{--style="height: 200px; "></a>--}}
            </div>
        </div>
    </script>

@endsection