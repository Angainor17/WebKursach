<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>

        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .header {
            height: 200px;
            background-color: #a066b3;
            margin-bottom: 10px;
        }

    </style>
    <script>
        function getClass(currentRow, seletedRow) {
            if (currentRow == seletedRow) {
                return "nav-link active";
            } else {
                return "nav-link";
            }
        }
    </script>
</head>

<body>
<div style="width: 200px; margin-top: 50px; margin-left: 20px;  border-style: solid;border-width: 1px;border-color: #1f648b" >
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
           href="{{url("/admin/article")}}"
           role="tab"
           aria-controls="v-pills-home" aria-selected="true" onclick="">Articles</a>
        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="{{url("/admin/product")}}"
           role="tab"
           aria-controls="v-pills-profile" aria-selected="true">Products</a>
        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="{{url("/admin/nutritionstrategy")}}"
           role="tab"
           aria-controls="v-pills-messages" aria-selected="true">Nutrition Strategy</a>
    </div>

    @if($pageName == "article")
        <script>document.getElementById("v-pills-home-tab").className = "nav-link active";</script>
    @endif
    @if($pageName == "product")
        <script>document.getElementById("v-pills-profile-tab").className = "nav-link active";</script>
    @endif
    @if($pageName == "nutritionstrategy")
        <script>document.getElementById("v-pills-messages-tab").className = "nav-link active";</script>
    @endif

    <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            ...
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...
        </div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...
        </div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...
        </div>
    </div>
</div>

</body>
</html>
