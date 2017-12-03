<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.datatables.min.css') }}" rel="stylesheet">

    {{--<script src="{{ asset('js/languageSwitcher.js') }}"></script>--}}
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>


    <script>
        $(document).ready(
            function () {
                $('#languageSwitcher').val('{{app()->getLocale()}}');

                $('#languageSwitcher').change(function () {
                    var locale = $(this).val();
                    var _token = $("input[name=_token]").val();

                    $.ajax({
                        url: "/language",
                        type: "POST",
                        data: {
                            locale: locale,
                            _token: _token
                        },
                        dataType: 'json',
                        complete: function () {
                            window.location.reload(true);
                        }

                    });
                })
            }
        );
    </script>

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100%;
            margin: 0;
        }

        .content {
            min-height: 100%;
        }

        .footer {
            position: relative;
            clear: both;
        }

        .row img {
            height: 65px;
            margin: 10px 20px;
        }


    </style>
</head>

<body>

<div class="content">
    <div class="container" style="border: 2px #1f648b;float: right;vertical-align: bottom;">
        @section("content")

        @show
    </div>

    <div style="width: 200px; vertical-align: top; margin-top: 150px; margin-left: 20px;  border-style: solid;border-width: 1px;border-color: #1f648b">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
               href="{{url("/admin/article")}}"
               role="tab"
               aria-controls="v-pills-home" aria-selected="true" onclick="">{{trans('app.articles')}}</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="{{url("/admin/product")}}"
               role="tab"
               aria-controls="v-pills-profile" aria-selected="true">{{trans('app.products')}}</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="{{url("/admin/nutritionstrategy")}}"
               role="tab"
               aria-controls="v-pills-messages" aria-selected="true">{{trans('app.nutritionStrategy')}}</a>
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

        <div class="tab-content" id="v-pills-tabContent" style="text-align: center">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
            </div>
        </div>
    </div>

</div>

<footer id="footer" class="footer">
    <nav class="navbar navbar-inverse">
        <div style="position: absolute; left: 0;margin-left: 170px;bottom: 20%;color: white">
            © Design by FeoTeam, 2017
        </div>
        <div class="container" id="footer-content">
            <div class="row" style="text-align: center">
                <a href="http:\\vk.com"><img src="{{asset("/default/vk.png")}}"></a>
                <a href="https:\\twitter.com/"><img src="{{asset("/default/twitter.png")}}"></a>
                <a href="http:\\google.com"><img src="{{asset("/default/google.png")}}"></a>
            </div>
        </div>

        <div style="position: absolute; left: 70%;bottom: 30%">
            <select id="languageSwitcher" data-width="fit">
                <option value="en">English</option>
                <option value="ru">Русский</option>
            </select>
        </div>


        <div style="position: absolute; right: 0;margin-right: 170px;bottom: 10%;color: white">
            <p>{{trans('app.telephoneNumber')}}: +7 (978) 837 03 04</p>
            <p>E-mail: angainor17@gmail.com</p>
        </div>
    </nav>
</footer>


</body>
</html>
