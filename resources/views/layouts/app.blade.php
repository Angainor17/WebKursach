<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/kendo.common.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kendo.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kendo.default.mobile.min.css') }}" rel="stylesheet">


    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/kendo.all.min.js') }}"></script>
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
    {{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}

    {{--<script src="{{ asset('js/popper.min.js') }}"></script>--}}


    <style>
        html, body {
            height: 100%;
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
<div id="app" class="content">
    <nav class="navbar navbar-inverse" style="border:2px solid #c3c3c3; height: 120px; position: relative">

        <a class="navbar-brand" href="{{ url('/') }}" style="margin-left: 7%">
            <img src="{{asset("/default/logo.gif")}}" style="height: 100px; ">
        </a>




        @if (Auth::guest())
            <div  style="position: absolute; left: 80%;top: 40%">
                <a href="{{ route('login') }}">
                    <button class="btn btn-primary" style="width: auto">{{trans('app.loginLabel')}}</button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="btn btn-primary" style="width: auto">{{trans('app.registerLabel')}}</button>
                </a>
            </div>
        @else
            <a href="{{ route('basket') }}" style="position: absolute;top: 25%;right: 0; margin-right: 23%"><img
                        src="{{asset("/default/cart.png")}}" style="height: 50px;"></a>

            <div style="position: absolute; left: 80%;top: 40%">
                <a href="{{ route('account') }}">
                    <button class="btn btn-primary" style="width: auto">{{trans('app.accountPage')}}</button>
                </a>
                <a href="{{ route('logout') }}">
                    <button class="btn btn-primary" style="width: 100px;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{trans('app.logoutLabel')}}
                    </button>
                </a>
            </div>

            <div style="position: absolute; left: 80%; top: 10%; color: white">{{trans('app.hiLabel')}} {{ Auth::user()->name }} </div>


            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>

        @endif

        <div class="container-fluid" style="font-size: 18px;position: absolute; bottom: 0; margin-left: 35%">
            <ul class="nav navbar-nav">
                <li><a href="/home">{{trans('app.homeLabel')}}</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"
                       href="/productsList">{{trans('app.products')}}</a>
                    {{--<span class="caret"></span></a>--}}
                    <ul class="dropdown-menu">
                        <li><a href="#">{{trans('app.protein')}}</a></li>
                        <li><a href="#">{{trans('app.vitamin')}}</a></li>
                        <li><a href="#">{{trans('app.tonik')}}</a></li>
                        <li><a href="#">{{trans('app.aminoacid')}}</a></li>
                        <li><a href="#">{{trans('app.gainer')}}</a></li>
                    </ul>
                </li>
                <li><a href="/home">{{trans('app.newsLabel')}}</a></li>
                <li><a href="#">{{trans('app.aboutLabel')}}</a></li>
            </ul>
        </div>


    </nav>
    @yield('content')
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
