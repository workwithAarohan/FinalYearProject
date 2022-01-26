@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-6 border shadow p-4 bg-white">
                <h4 class="mb-4"> <b>{{ $batch->batch_name }}</b> - Edit</h4>
                <form action="{{ route('course.newSession.store') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="mb-3">
                            <label for="batch_name" class="form-label">
                                Batch
                            </label>
                            <input type="text" id="batch_name" name="batch_name" class="form-control @error('batch_name') is-invalid @enderror" value="{{ $batch->batch_name }}">
                            @error('batch_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">
                                Batch Year
                            </label>
                            <input type="text" id="year" name="year" class="form-control @error('year') is-invalid @enderror" value="{{ $batch->year }}">
                            @error('year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="batch_description" class="form-label">
                            Batch Description
                        </label> <br>
                        <textarea name="batch_description" id="batch_description" cols="50" rows="5" class="form-control @error('batch_description') is-invalid @enderror">{{ $batch->batch_description }}</textarea>
                        @error('batch_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-secondary" type="submit">
                        Edit Batch
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
