<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Name</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/kendo.common.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kendo.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kendo.default.mobile.min.css') }}" rel="stylesheet">


    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/kendo.all.min.js') }}"></script>
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

    </style>
</head>
<body>
<div id="app" class="content">
    <nav class="navbar navbar-inverse" style="border:2px solid #c3c3c3; height: 120px">

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset("/default/logo.gif")}}" style="height: 100px">
        </a>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('basket') }}"><img src="{{asset("/default/cart.png")}}" style="height: 50px;"></a>
                </li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">
                            <button class="btn btn-primary">Login</button>
                        </a></li>
                    <li><a href="{{ route('register') }}">
                            <button class="btn btn-primary">Register</button>
                        </a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li>
                                <a>
                                    Account
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <button>Log Out</button>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')
</div>

<footer id="footer" class="footer">
    <nav class="navbar navbar-inverse">
        <div class="container" id="footer-content">
            <div class="row">
                <a href="http:\\vk.com">VK</a>
                <a href="http:\\vk.com">VK</a>
                <a href="http:\\vk.com">VK</a>
            </div>
        </div>
    </nav>
</footer>

</body>
</html>
