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

        .inline {
            display: inline-block;
            margin-left: 30px;
            margin-right: 30px;
        }

        .day {
            border: 1px solid #b9b9b9;
            width: 900px;
            height: auto;
            margin: 20px;
            font-size: 16px;
            padding: 20px;
        }
    </style>

    <script>

        function checkProduct(week, id) {
            $.ajax({
                url: "/addMeal",
                type: "POST",
                dataType: "json",
                data: {
                    id: id
                },
                success: function () {

                }
            });
            $("#"+week+"addMeal" + id).html('Checked!');
            $("#"+week+"addMeal" + id).attr('disabled', true);
        }

        function goToProduct(id) {
            window.location.href = "/product/" + id;
        }

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

            <p style="text-align: left">#:weekDay# #:dateString#</p>
            <div style="text-align: left; width: 700px">
                # for (var i = 0; i < notification.length; i++) { #
                <div style="text-align: left;">
                    <img class="inline" src="#:notification[i].imageId#" style="height: 70px;">
                    <p class="inline">#:notification[i].text#</p>
                    # if (notification[i].type == 1) { #
                    <button class="inline" id="#:weekDay#addMeal#:notification[i].productId#" class="btn btn-success"
                            onclick="checkProduct('#:weekDay#','#:notification[i].productId#')">{{trans('app.check')}}</button>
                    # } #

                    # if (notification[i].type == 0) { #
                    <button class="inline" class="btn btn-success"
                            onclick="goToProduct('#:notification[i].productId#')">{{trans('app.inCartLabel')}}</button>
                    # } #

                </div>
                # } #
            </div>
        </div>
    </script>


    <div>
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap" style="margin-bottom: 15%"></div>
    </div>

@endsection