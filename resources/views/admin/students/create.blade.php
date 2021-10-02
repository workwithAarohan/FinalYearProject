@extends('layouts.nav')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Admission Form') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('student.store') }}">
                @csrf

                <div class="mb-3 row">
                    <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                    <div class="col-md-6">
                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}"  autocomplete="firstname" autofocus>

                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="col-md-6">
                        <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="temporaryAddress" class="col-md-4 col-form-label text-md-right">{{ __('Temporary Address') }}</label>

                    <div class="col-md-6">
                        <input id="temporaryAddress" type="text" class="form-control @error('temporaryAddress') is-invalid @enderror" name="temporaryAddress"  autocomplete="temporaryAddress">

                        @error('temporaryAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="permanentAddress" class="col-md-4 col-form-label text-md-right">{{ __('Permanent Address') }}</label>

                    <div class="col-md-6">
                        <input id="permanentAddress" type="text" class="form-control @error('permanentAddress') is-invalid @enderror" name="permanentAddress"  autocomplete="permanentAddress">

                        @error('permanentAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  autocomplete="phone">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                    <div class="col-md-6">
                        <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"  autocomplete="dob">

                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                    <div class="form-check col-md-3 ms-4">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" checked>
                        <label class="form-check-label" for="gender">
                          Male
                        </label>
                    </div>
                    <div class="form-check col-md-3">
                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Female">
                        <label class="form-check-label" for="gender">
                          Female
                        </label>
                    </div>

                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                

                <div class="mb-3 row">
                    <label for="nationality" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>

                    <div class="col-md-6">
                        <input id="nationality" type="text" class="form-control @error('nationality') is-invalid @enderror" name="nationality"  autocomplete="nationality">

                        @error('nationality')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @foreach ($roles as $role)
                    <input type="hidden" name="roles[]" value="{{ $role->id }}">
                @endforeach
                



                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
