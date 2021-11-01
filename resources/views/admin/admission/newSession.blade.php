@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center border shadow p-4">
            <h4 class="mb-4"> <b>{{ $course->courseDetails->slug }}</b> Course New Session</h4>
            <form action="{{ route('course.newSession.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="batch_name">
                        Batch
                    </label>
                    <input type="text" id="batch_name" name="batch_name">
                    &emsp13;

                    <label for="year">
                        Batch Year
                    </label>
                    <input type="text" id="year" name="year">
                </div>

                <div class="mb-3">
                    <label for="batch_description" class="form-label">
                        Batch Description
                    </label> <br>
                    <textarea name="batch_description" id="batch_description" cols="50" rows="5"></textarea>
                </div>

                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <input type="hidden" name="created_by" value=" {{ auth()->user()->id }}">

                <button class="btn btn-secondary" type="submit">
                    Start New Session
                </button>
            </form>
        </div>
    </div>
@endsection
