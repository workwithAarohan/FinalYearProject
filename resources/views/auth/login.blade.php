@extends('layouts.nav')

<link rel="stylesheet" href="/css/login.css">

@section('content')
    <div class="container">
        <div class="row justify-content-center p-5 mt-4 bg-white shadow rounded">
            <div class="col-lg-7 mb-5">
                <center>
                    <img src="images/logo/images.jfif" alt="book" class="image mt-4" style="width: 250px; object-fit: cover;">

                    <h3><strong>Learn it. Earn it.</strong></h3>
                </center>


            </div>
            <div class="col-lg-5 p-3 mb-2 shadow">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h4 class="align-middle"><b>Login to continue</b></h4>
                    <img src="/images/logo/academia_logo.png" style="width: 125px; object-fit: cover;">
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-4 mt-5">
                        <input class="input @error('username') is-invalid @enderror" type="username" id="username" name="username" placeholder="username" value="{{ old('username') }}"  autocomplete="username" autofocus>
                        <label for="username" class="label">Username</label>

                        @error('username')
                            <span class="invalid-feedback" style="margin-top:-15px">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class=" input-group">
                        <input class="input @error('password') is-invalid @enderror" type="password" id="password" placeholder="Password" name="password"  autocomplete="current-password">
                        <label for="password" class="label">Password</label>
                        <span class="password-display">
                            <i class="fa fa-eye" aria-hidden="true" id="eye"></i>
                        </span>

                        @error('password')
                            <span class="invalid-feedback" role="alert" style="margin-top:-15px">
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




















{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
