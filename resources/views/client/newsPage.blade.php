@extends("layouts.app", ["title"=>trans('app.newsPage')])

@section("content")

    <style>

        .article {
            width: 554px;
            height: 400px;
            font-size: 16px;
            padding: 20px;
            display: inline-block;
            margin-bottom: 75px;
            margin-right: 50px;
            position: relative;
            background-color: #e6e6e6;
        }

        .article img {
            max-width: 480px;
            border: solid 3px #d4d9d4;
            margin: 2px;
        }

        .articleTitle {
            padding-right: 10%;
        }

        .articleText {
            word-wrap: break-word;
            float: left;

            text-align: left;
        }

        .articleDate {
            font-size: 14px;
            color: #717171;
            margin-bottom: 25px;
            display: block;
        }

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

        #readMoreBtn {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-bottom: 30px;
            margin-left: 10px;
        }

        .imageDiv {
            text-align: center;
        }


    </style>

    <div>
        <div id="listView"></div>
        <div id="pager" class="k-pager-wrap"></div>
    </div>

    <script type="text/x-kendo-template" id="template">
        <div class="article">
            <div class="imageDiv">
                <a href="/article/#:id#"><img class="card-img-top"
                                              src="{{asset('/uploads/')}}/#:imageId#"
                                              style="height: 150px; "></a>
            </div>

            <a href="/article/#:id#"><p class="articleTitle">#:title#</p></a>
            <p class="articleDate" style="float: left">#:date#</p><br>
            <div class="articleText">#:short#</div>
            <a id="readMoreBtn" href="/article/#:id#">
                <button type="button" class="btn btn-info">Read more...</button>
            </a>
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