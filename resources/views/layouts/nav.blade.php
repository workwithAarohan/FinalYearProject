<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>

    <script src="{{ asset('js/circle-progress.min.js') }}"></script>

    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    {{-- CkEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('style')

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0078D4; height: 50px;">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ route('home') }}">
                <strong>Academia College</strong>
            </a>

            <button class="navbar-toggler ms-auto" type="" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-ellipsis-h"></span>
            </button>

            @can('logged-in')
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="{{ route('course.index') }}">Course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('batch.index') }}">Batch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('semester.index') }}">Semester</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('subject.index') }}">Subject</a>
                        </li>

                    </ul>

                </div>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link  text-white position-relative" href="{{ url('/notification') }}">
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
                        <a class="nav-link  text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                            {{-- @if (Auth::user()->roles->name == 'Student')
                                <li><a class="dropdown-item" href="{{ route('student.performance', auth()->user()->student->id) }}">My Performance</a></li>
                            @endif --}}
                            <li><hr class="dropdown-divider"></li>
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


    <main class="py-4">
        @include('partials.alert')
        @yield('content')
    </main>

    @yield('script')
</body>
</html>
