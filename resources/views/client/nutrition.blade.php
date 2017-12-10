@extends("client.accountFrame", ["title"=>trans('app.nutritionStrategy')])

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

        #pager {
            margin-left: 6%;
            margin-right: 6%;
        }

        .day {
            border: 1px solid #b9b9b9;
            width: 700px;
            height: 350px;
            margin: 20px;
            font-size: 16px;
            padding: 20px;
            text-align: center;
        }
    </style>

    <script>
        $(document).ready(function () {
            menuActive();
        });

        function menuActive() {
            $('#nutritionStrategy').addClass("active");
        }

        $(function () {
            var dataSource = new kendo.data.DataSource({
                pageSize: 7,
                transport: {
                    read: {
                        url: "nutritionStrategyList",
                        dataType: "json"
                    }
                }
            });

            $("#listView").kendoListView({
                dataSource: dataSource,
                template: kendo.template($("#template").html())
            });

            $("#pager").kendoPager({
                dataSource: dataSource
            })
        })

    </script>

    <script type="text/x-kendo-template" id="template">
        <div class="day">

            <p style="text-align: left">#:dateString# #:weekDay#</p>

            # for (var i = 0; i < notification.length; i++) { #
            lol
            <div>
                #:notification[1].type#
                <p>#:notification[i].text#</p>
                <img src="http://mynutritionway.com/uploads/#:notification[i].imageId#" style="height: 70px">
                # if (notification[i].type === 1) { #
                <button>Check</button>
                # } #

                # if (notification[i].type != 0) { #
                <button>Buy</button>
                # } #

            </div>
            # } #
        </div>
    </script>


    <div>
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap" style="margin-bottom: 15%"></div>
    </div>

@endsection