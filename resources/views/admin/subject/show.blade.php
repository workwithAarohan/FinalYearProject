@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-6">

                <h4> <b>{{ $subject->subject_code }}</b> - {{ $subject->subject_name }}</h4>
                <p>{{ $subject->description }}</p>
            </div>
            <div class="col">
                <h5 class=""><strong>{{ $subject->credit_hrs }} hrs</strong></h5>

            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <strong>Course: </strong><h6>{{ $subject->course->course_name }}</h6>
                <strong>Status: </strong>
                <i>
                    @if ($subject->is_active)
                        Active
                    @else
                        Not Active
                    @endif
                </i>
            </div>
            <div class="col-md-4">
                <strong>Semester: </strong><h6>{{ $subject->semester->semester_name }}</h6>
            </div>

        </div>
    </div>
@endsection
