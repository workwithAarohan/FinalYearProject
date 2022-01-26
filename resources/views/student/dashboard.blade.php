@extends('layouts.nav')

@section('style')
    <style>
        h5.background
        {
            font: 14px sans-serif;
            margin-top: 30px;
            margin-bottom: 30px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            z-index: 1;
            font-weight: bold;
        }

        h5.background:before
        {
            border-top: 1px solid #ccc6c6;
            content:"";
            margin: 0 auto;
            position: absolute;
            top: 8px; left: 0; right: 0; bottom: 0;
            width: 95%;
            z-index: -1;
        }

        h5.background span
        {
            background: #F8FAFC;
            padding: 0 15px;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-3">
        {{ $student->user->firstname }} <br>

        <div class="row justify-content-center">
            <h5 class="background">
                <span>Classrooms</span>
            </h5>
            @foreach ($classrooms as $classroom)
                @if ($classroom->is_active)
                    <div class="col-md-8 bg-white shadow mb-3 p-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex">
                                <div class="image me-4">
                                    <img src="{{ asset('images/background/'. $classroom->image) }}" style="width: 200px;">
                                </div>
                                <div class="body">
                                    <h6 class="text-muted" style="font-size: 12px;">{{ $classroom->batch->course->courseDetails->slug }}</h6>
                                    <a href="{{ route('classroom.dashboard', $classroom->id) }}" style="text-decoration: none; color: #0056D2; font-weight: bold; font-size: 20px;"> {{ $classroom->room_name }}</a>
                                    <p>{{ $classroom->subject->subject_name }}</p>
                                </div>

                            </div>
                            <div class="d-flex align-items-center" style="height: 100px;">
                                <div class="vr"></div>
                                <div class="ms-3 p-2 me-3">
                                    <h5 class="fs-6 fw-bold text-center">Course Completed</h5>
                                    <div class="progress" style="height: 15px; position: relative;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $classroom->courseCompleted }}%" aria-valuenow="{{ $classroom->courseCompleted }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        <h6 class="fw-bold my-auto" style="position: absolute; left: 50%; top: 1px; font-size: 13px; ">
                                            {{ $classroom->courseCompleted }}%
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>
@endsection
