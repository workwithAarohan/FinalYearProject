@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row w-25">
            <form action="{{ route('batch.update', $batch->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- <input type="hidden" name="course_id" value="{{ $course->id }}">

                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}"> --}}

                <div class="mb-3">
                    <label for="batch_name" class="form-label">
                        Batch Name:
                    </label>

                    <input type="text" class="form-control @error('batch_name') is-invalid @enderror" id='batch_name' name="batch_name" value="{{ $batch->batch_name }}" autofocus>

                    @error('batch_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- <span class="invalid-feedback">
                        @error('batch_name')
                            <strong>{{ $message }}</strong>

                        @enderror
                    </span> --}}
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">
                        Year:
                    </label>

                    <input type="text" class="form-control @error('year') is-invalid @enderror" id='year' name="year" value="{{ $batch->year }}" >

                    @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="batch_description" class="form-label">
                        Description:
                    </label>

                    <textarea class="form-control @error('batch_description') is-invalid @enderror" name="batch_description" id='batch_description' cols="50" rows="5">{{ $batch->batch_description }}</textarea>

                    @error('batch_description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <button type="submit" class="btn btn-outline-success">Update</button>
            </form>
        </div>
    </div>
@endsection
