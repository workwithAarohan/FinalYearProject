@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6 border shadow p-4 bg-white">
                <h4 class="mb-4"> <b>{{ $role->name }}</b> - Edit</h4>
                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Role
                            </label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button class="btn btn-secondary" type="submit">
                        Edit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
