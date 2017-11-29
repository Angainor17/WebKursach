<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$pageName}}</title>
    <link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="http://cdn.phpoll.com/css/animate.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
    <!-- or -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <!-- Styles -->
    <style>

        /* Fixed navbar */
        body {
            padding-top: 90px;
        }
        /* General sizing */
        ul.dropdown-lr {
            width: 300px;
        }

        /* mobile fix */
        @media (max-width: 768px) {
            .dropdown-lr h3 {
                color: #eee;
            }
            .dropdown-lr label {
                color: #eee;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Project Name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">Home</a></li>
                <li><a href="">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="http://phpoll.com/register" class="dropdown-toggle" data-toggle="dropdown">Register <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-lr animated flipInX" role="menu">
                        <div class="col-lg-12">
                            <div class="text-center"><h3><b>Register</b></h3></div>
                            <form id="ajax-register-form" action="http://phpoll.com/register/process" method="post"
                                  role="form" autocomplete="off">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2"
                                           class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6 col-xs-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-info" value="Register Now">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token"
                                       value="7c6f19960d63f53fcd05c3e0cbc434c0">
                            </form>
                        </div>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="http://phpoll.com/login" class="dropdown-toggle" data-toggle="dropdown">Log In <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                        <div class="col-lg-12">
                            <div class="text-center"><h3><b>Log In</b></h3></div>
                            <form id="ajax-login-form" action="http://phpoll.com/login/process" method="post"
                                  role="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <input type="checkbox" tabindex="3" name="remember" id="remember">
                                            <label for="remember"> Remember Me</label>
                                        </div>
                                        <div class="col-xs-5 pull-right">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-success" value="Log In">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="http://phpoll.com/recover" tabindex="5"
                                                   class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="hide" name="token" id="token"
                                       value="a465a2791ae0bae853cf4bf485dbe1b6">
                            </form>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">Be sure to include <a href="http://daneden.github.io/animate.css/"
                                                                 target="_blank" title="animate.css">animate.css</a> for
            the animations
        </div>
    </div>
</div>
@section('mainPage')

@endsection

</body>
</html>