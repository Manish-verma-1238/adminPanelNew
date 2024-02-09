<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>zipZap</title>
    <meta charset="UTF-8" />
    <link rel="icon" href="{{asset('assets/frontend/uploads/logo nav.png')}}" type="image/x-icon" />
    <link rel="preload" href="{{asset('assets/frontend/assets/maxcdn.bootstrapcdn.com/bootstrap/bootstrap.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{asset('assets/frontend/assets/maxcdn.bootstrapcdn.com/font-awesome/font-awesome.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{asset('assets/frontend/assets/frontuser/css/owl.carousel.min2.css')}}" as="style">
    <link rel="stylesheet" href="{{asset('assets/frontend/assets/cdnjs.cloudflare.com/owl.theme.default.min.css')}}" as="style">
    <link rel="preload" href="{{asset('assets/frontend/assets/frontuser/css/animate.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{asset('assets/frontend/assets/frontuser/css/style.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{asset('assets/frontend/assets/frontuser/css/date-picker.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{asset('assets/frontend/assets/frontuser/css/jquery.datetimepicker.min.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{asset('assets/frontend/assets/frontuser/css/jquery.datetimepicker.min.css')}}">
    </noscript>
    <link href="{{asset('assets/frontend/assets/frontuser/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css" media="all">

    <!-- Third party links -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" style="font-display: swap;">
    <style>
        @media only screen and (min-width: 769px) {
            .pac-container {
                border-radius: 5px;
                padding: 5px;
                margin-top: -150px;
            }
        }

        .pac-container:after {
            content: none !important;
        }

        .pac-item,
        .pac-item-query {
            font-size: 1em;
            font-family: 'Nunito Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>

    <script src="{{asset('assets/frontend//assets/frontuser/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/frontend//assets/code.jquery.com/jquery-ui.min.js')}}" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>

    <div class="main fixed-top">
        <nav class="navbar navbar-expand-md header_bg sidebarNavigation" data-sidebarClass="navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand logo-img" href="#">
                    <img src="{{asset('assets/frontend/uploads/logo nav.png')}}" height="75px">
                </a>
                <button class="navbar-toggler leftNavbarToggler bg-size" type="button" style="background-image: url('{{asset('assets/frontend/assets/frontuser/images/icons/menu.png')}}');" data-toggle="collapse" data-target="#menu_bar" aria-controls="menu_bar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="menu_bar">
                    <ul class="nav navbar-nav nav-flex-icons m-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Cabs fleet</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link br_n" href="#">Contact Us</a>
                        </li>
                    </ul>
                    <div class="top_btn">
                        <a href="tel:9054865866" class="singup_btn sign ">BOOK NOW</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>