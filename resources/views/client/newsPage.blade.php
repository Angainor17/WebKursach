@extends("layouts.app")

@section("content")
    1212121Женя

    <div class="demo-section k-content wide">
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap"></div>
    </div>


    <script type="text/x-kendo-template" id="template">
        <div class="article">
            <div>#:name#</div>
            <div>#:id#</div>
            <div>#:short#</div>
            <div>#:full#</div>
            <div>4567890</div>
        </div>
    </script>

    <script>

        $(function () {
            var dataSource = new kendo.data.DataSource({
                transport: {
                    read: {
                        url: "articles",
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

@endsection