@extends("layouts.app")

@section("content")

    <div class="demo-section k-content wide">
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap"></div>
    </div>

    <script type="text/x-kendo-template" id="template">
        <div class="article">
            <div style="border: solid 1px black">
                <img src="{{asset('/uploads/')}}/#:imageId#" style="width: 100px;height: 100px; float: left">
                <div><h2>Title: #:title#</h2></div>
                <div><h3>Date #:date#</h3></div>
                <a href="/article/#:id#">Read</a>
                <div>Short: #:short#</div>
            </div>
        </div>
    </script>

    <script>

        $(function () {
            var dataSource = new kendo.data.DataSource({
                pageSize: 10,
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

            $("#pager").kendoPager({
                dataSource: dataSource
            })
        })
    </script>

@endsection