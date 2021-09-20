@extends('layouts.app')

<link rel="stylesheet" href="/css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('content')
    <div class="container">
        <div class="row justify-content-center p-5 mt-4 bg-white shadow rounded">
            <div class="col-lg-7">
                <center>
                    <img src="images/logo/images.jfif" alt="book" class="image mt-5" style="width: 345px; object-fit: cover;">
                </center>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <div class="col-lg-5 p-3 mb-2">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h4 class="align-middle"><b>Login to continue</b></h4>
                    <img src="/images/logo/academia_logo.png" style="width: 125px; object-fit: cover;">
                    
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-4 mt-5">
                        <input class="input @error('username') is-invalid @enderror" type="username" id="username" name="username" placeholder="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        <label for="username" class="label">Username</label>

                        @error('username')
                            <span class="invalid-feedback" style="margin-top:-15px">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class=" input-group">
                        <input class="input @error('password') is-invalid @enderror" type="password" id="password" placeholder="Password" name="password" required autocomplete="current-password" style="position: relative">
                        <label for="password" class="label">Password</label>
                        <span class="password-display">
                            <i class="fa fa-eye" aria-hidden="true" id="eye"></i>
                        </span>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <a href="{{ route('password.request') }}" class="small mb-3 float-end">
                        <strong>Forget Password?</strong>
                    </a><br>

                    <div class="mb-3 mt-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>

                    <input type="submit" value="LOGIN" class="form-control btn mb-1"
                    style="background-color: #3241c7; color: white;">
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function()
        {
            const password = $('#password');
            $('#eye').click(function(){
                if(password.prop('type') == 'password')
                {
                    $(this).addClass('fa-eye-slash');
                    password.attr('type', 'text');
                }
                else
                {
                    $(this).removeClass('fa-eye-slash');
                    password.attr('type', 'password');
                }

            });
        });
    </script>

@endsection