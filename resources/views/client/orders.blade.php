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
            height: 180px;
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
            <p>{{trans('app.customer')}}: #:name#</p>
            <p>{{trans('app.totalCostLabel')}}: #:cost# {{trans('app.rub')}}</p>
            <p>{{trans('app.dateColumn')}}: #:date#</p>

            # for (var i = 0; i < products.length; i++) { #

            <div style="display: inline-block">
                <img src="http://mynutritionway.com/uploads/#:products[i].imageId#" style="height: 70px">
            </div>
            # } #

        </div>
        </div>
    </script>

@endsection