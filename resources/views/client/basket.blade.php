@extends("client.accountFrame", ["title"=>trans('app.cartPage')])

@section("innerContent")

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