<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>

        <script src="{{ asset('js/circle-progress.min.js') }}"></script>

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>

        <style>
            .sidebar
            {
                margin: 0;
                padding: 0;
                width: 200px;
                top:50px;
                background-color: #ffffff;
                position: fixed;
                height: 100%;
                overflow: auto;
                border-right: 1px solid #e6e4e4;
            }

            .sidebar .list > li
            {
                margin-left: -32px;
                list-style: none;
            }

            .sidebar .list
            {
                margin-top: -10px;
            }

            .sidebar .list > li a
            {
                display: block;
                color: #000000;
                padding: 6px 20px;
                text-decoration: none;
                font-weight: bold;
                font-size: 15px;
            }

            .sidebar .list > li a:hover
            {
                background-color: #155bdb;
                color: #ffffff;
            }

            div.content
            {
                margin-left: 200px;
                margin-top: 50px;
                padding: 1px 16px;
            }

            @media screen and (max-width: 700px)
            {
                .sidebar
                {
                    width: 100%;
                    height: auto;
                    position: relative;
                }

                .sidebar a {float: left;}
                div.content {margin-left: 0;}
            }

            @media screen and (max-width: 400px)
            {
                .sidebar a
                {
                    text-align: center;
                    float: none;
                }
            }

            @yield('style');
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light w-100" style="background-color: #ffffff; height: 50px; position: fixed; border-bottom: 1px solid #e6e4e4; z-index: 1 !important">
            <div class="container">
                <a class="navbar-brand text-dark" href="{{ route('home') }}">
                    <strong>Academia College</strong>
                </a>

                <button class="navbar-toggler ms-auto" type="" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fas fa-ellipsis-h"></span>
                </button>

                @can('logged-in')
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link active text-dark" aria-current="page" href="{{ route('course.index') }}">Course</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('batch.index') }}">Batch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('semester.index') }}">Semester</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('subject.index') }}">Subject</a>
                            </li>

                        </ul>

                    </div>

                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link  text-dark position-relative" href="{{ url('/notification') }}">
                                <i class="far fa-bell"></i>
                                @if (auth()->user()->unreadNotifications->count() !=0)
                                    <span class="position-absolute translate-middle p-1 bg-danger rounded-circle" style="top:12px;">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>
                @endcan


                <ul class="navbar-nav me-auto ">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                    @else
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link  text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                                {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu " aria-labelledby="navbarDropdown" >

                                {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>

                    @endguest

                </ul>
            </div>
        </nav>

        <div class="sidebar">
            <h5 style="font-size: 18px; color:#ffffff; padding:10px 20px; background: #0b5eca; font-weight: bold;" class="">
                <i class="fas fa-home me-2"></i> Dashboard
            </h5>
            <h5 style="font-size: 12px; color:#959191; padding:10px 20px; font-weight: bold; text-transform: uppercase;" class="side-heading">
                Pages
            </h5>
            <ul class="list">
                @role('Admin')
                    <li>
                        <a href="{{ route('role.index') }}">
                            <i class="far fa-calendar me-2"></i> Role
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('course.index') }}">
                            <i class="far fa-calendar me-2"></i> Course
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('semester.index') }}">
                            <i class="far fa-calendar me-2"></i> Semester
                        </a>
                    </li>
                @endrole
                <li>
                    <a href="{{ route('students.list') }}">
                        <i class="far fa-calendar me-2"></i> Student
                    </a>
                </li>
                @role('Coordinator')
                    <li>
                        <a href="{{ route('examination.index') }}">
                            <i class="far fa-calendar me-2"></i> Examination
                        </a>
                    </li>
                @endrole
            </ul>
        </div>

        <main class="py-4">
            <div class="content">
                @include('partials.alert')
                @yield('content')
            </div>
        </main>

        <script>
            @yield('script');
        </script>
    </body>
</html>






