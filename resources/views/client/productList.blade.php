@extends("layouts.app", ["title"=>"Products"])

@section("content")

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

        .title {
            color: black;
            font-style: italic;
        }

        .producer {
            color: black;
            font-style: oblique;
        }

        .cost {
            color: red;
        }

        .product {
            border: 2px solid #b9b9b9;
            width: 300px;
            height: 330px;
            margin: 20px;
            font-size: 16px;
            padding: 20px;
            display: inline-block;
            text-align: center;
        }
    </style>

    <div>
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap"></div>
    </div>


    <script type="text/x-kendo-template" id="template">
        <div class="product">

            <div class="imageDiv">
                <a href="/product/#:id#"><img class="card-img-top" src="{{asset('/uploads/')}}/#:imageId#"
                                              style="height: 200px; "></a>
            </div>

            <p>Name #:name#</p>
            <p class="producer">Producer #:producer#</p>

            <p class="cost">#:cost# руб.</p>
            <p>Instock = #:instock#</p>
        </div>
    </script>

    <script>

        $(function () {
            var dataSource = new kendo.data.DataSource({
                pageSize: 10,
                transport: {
                    read: {
                        url: "products",
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


@endsection