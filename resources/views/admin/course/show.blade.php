@extends('layouts.common')

@section('title')
    {{ $course->course_name }} - Course
@endsection

@section('content')

    <div class="container">
        <a href="{{ route('course.newSession', $course->id) }}" class="btn btn-primary float-end" >
            New Session
        </a>
        <h4>
            <strong>
                {{ $course->course_name }}
            </strong> <br>
            ({{ $course->courseDetails->slug }})
        </h4>
        <p>
            {{ $course->description }}
        </p>

        <div class="row">
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="card" style="width:100%;">
                        {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                          <h5 class="card-title">Description</h5>
                          <p class="card-text">{{ $course->courseDetails->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card">
                        {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                          <h5 class="card-title">Objective</h5>
                          <p class="card-text">{{ $course->courseDetails->objective }}</p>
                        </div>
                    </div>
                </div>
                <div class="row bg-white p-3 border">
                    <h4>Subject</h4>
                    @foreach ($semesters as $semester)
                        <div class="col-md-6">
                            <div class="card-header">
                                {{ $semester->semester_name }} Semester
                            </div>
                            <ul>
                                @foreach($semester->subject as $subject)
                                    @if(!$subject->is_elective)
                                        <li><b>{{ $subject->subject_code }}</b> - {{ $subject->subject_name }}</li>
                                    @endif
                                @endforeach

                                @if ($semester->electiveCount>=1)
                                    <h6 class="fw-bold mt-2"><u>Electives:</u></h6>
                                @endif

                                @foreach($semester->subject as $subject)
                                    @if($subject->is_elective)
                                        <li><b>{{ $subject->subject_code }}</b> - {{ $subject->subject_name }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body ">
                        <a href="{{ route('course.batches', $course->id) }}" class="text-decoration-none">
                            <h5 class="card-title fw-bold ">Batch</h5>
                        </a>
                        <h6 class="card-subtitle mb-2 text-muted ">{{ $course->batches()->count() }}</h6>

                    </div>
                </div>
                @role('Admin')
                    <div class="card mt-3">
                        <div class="card-body ">
                            <a href="{{ route('course.subject.create', $course->id) }}" class="btn btn-success float-end">
                                Add Subject
                            </a>
                            <a href="{{ route('course.subject.create', $course->id) }}" class="text-decoration-none">
                                <h5 class="card-title fw-bold ">Subject</h5>
                            </a>
                            <h6 class="card-subtitle mb-2 text-muted ">{{ $course->subjects()->count() }}</h6>

                        </div>
                    </div>
                @endrole
            </div>
        </div>
    </div>
@endsection
