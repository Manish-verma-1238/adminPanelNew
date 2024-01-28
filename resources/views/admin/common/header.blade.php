<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{$pageTitle}} &mdash; {{ucwords($userProfile['panel_name']) ?? 'Admin Panel'}}</title>
    <link rel="icon" href="{{asset('/assets/admin/assets/img/upload/user-profile/').'/'.$user->userProfile->panel_logo ?? asset('/assets/admin/assets/img/avatar/avatar-1.png')}}" type="image/icon type">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/admin/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/admin/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/modules/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/assets/css/components.css')}}">

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                @foreach(auth()->user()->notifications as $notification)
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>"{{ $notification->data['name'] }}" started following Jimeet Blogs.</b>
                                        <div class="time text-primary">{{ $notification->created_at }} Min Ago</div>
                                    </div>
                                </a>
                                @endforeach
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('/assets/admin/assets/img/upload/user-profile/').'/'.$user->userProfile->panel_logo ?? asset('/assets/admin/assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{$user->name ?? 'User'}}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">{{$user->name ?? 'User'}}</div>
                            <a href="{{route('user.profile')}}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{route('dashboard')}}">{{$userProfile['panel_name'] ?? 'Admin Panel'}}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        @php
                        $string =$userProfile['panel_name'] ?? 'Admin Panel';
                        $words = str_word_count($string, 1); // Split the string into an array of words
                        $firstLetters = array_map(function($word) {
                        return strtoupper(substr($word, 0, 1)); // Get the first letter and convert to uppercase
                        }, $words);
                        $shortName = implode('', $firstLetters);
                        @endphp
                        <a href="{{route('dashboard')}}">{{$shortName}}</a>
                    </div>
                    <ul class="sidebar-menu">
                        @php
                        //This code is used to active inside pages.
                        $uri = request()->path();
                        $segments = explode('/', $uri);
                        $firstSegment = isset($segments[0]) ? $segments[0] : null;
                        @endphp
                        <li class="menu-header">Dashboard</li>
                        @foreach($navbars as $navbar)
                        @if($navbar->parent_id == null)
                        <li class="dropdown {{ (url()->current() == $navbar->url || \Str::contains($navbar->url, $firstSegment, false) || $navbar->childs->contains(function ($child) { return url()->current() == $child->url; })) ? 'active' : '' }}">
                            <a href="{{ ($navbar->childs->count()) ? '#' : $navbar->url }}" class="nav-link {{ ($navbar->childs->count()) ? 'has-dropdown' : '' }}">{!!
                                $navbar->icon !!}<span>{{$navbar->title}}</span></a>
                            @if($navbar->childs->count())
                            <ul class="dropdown-menu">
                                @foreach($navbar->childs as $navChild)
                                <li class="{{ (url()->current() == $navChild->url) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{$navChild->url}}">{{$navChild->title}}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </aside>
            </div>