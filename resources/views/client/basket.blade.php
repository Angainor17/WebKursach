@extends("client.accountFrame", ["title"=>trans('app.cartPage')])

@section("innerContent")

    <style>
        #listView {
            margin-left: 6%;
            padding-top: 50px;
            margin-right: 6%;
            padding-bottom: 6%;
            display: block;
            text-align: center;
        }

        .cost {
            color: red;
        }

        .product {
            border: 2px solid #b9b9b9;
            width: 300px;
            height: 270px;
            margin: 5px;
            font-size: 16px;
            padding: 5px;
            display: inline-block;
            text-align: center;
        }
    </style>

    <div>
        <div id="listView"></div>
    </div>



    <script type="text/x-kendo-template" id="template">
        <div class="product">

            <div class="imageDiv">
                <a href="/product/#:id#"><img class="card-img-top" src="{{asset('/uploads/')}}/#:imageId#"
                                              style="height: 200px; "></a>
            </div>

            <p>#:name#</p>
            <p class="cost">#:cost# {{trans('app.rub')}}</p>
        </div>
    </script>

    <script>

        $(function () {
            var dataSource = new kendo.data.DataSource({
//                pageSize: 10,
                transport: {
                    read: {
                        url: "basketProductList",
                        dataType: "json"
                    }
                }
            });

            $("#listView").kendoListView({
                dataSource: dataSource,
                template: kendo.template($("#template").html())
            });

//            $("#pager").kendoPager({
//                dataSource: dataSource
//            })
        })
    </script>


@endsection