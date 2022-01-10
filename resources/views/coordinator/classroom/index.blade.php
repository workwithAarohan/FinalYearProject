@extends('layouts.nav')

@section('style')
    <style>
        h5.background
        {
            font: 14px sans-serif;
            margin-top: 30px;
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

        .bottom-element
        {
            position: absolute;
            bottom: 1px;
            border-top: 2px solid #382d2d;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="float-start">
                    Classroom - Batch {{ $batch->batch_name }} ({{ $batch->course->courseDetails->slug }})
                </h1>

                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Classroom
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="selectCourse">Select Course and Semester</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('classroom.create') }}" method="GET">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden"  id="batch" name="batch_id" value="{{ $batch->id }}">
                                    <input type="hidden"  id="course" name="course_id" value="{{ $batch->course->id }}">

                                    <div class="mb-3">
                                        <label for="" class="form-label">Course</label>
                                        <input type="text" value="{{ $batch->course->courseDetails->slug }}" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Batch</label>
                                        <input type="text" value="{{ $batch->batch_name }}" class="form-control" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Semester</label>
                                        <select name="semester_id" id="semester" class="form-control">
                                            @foreach ($semesters as $semester)
                                                <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 mx-5 justify-content-center" style="column-gap: 20px;">
            @foreach ($semesters as $semester)
                <h5 class="background">
                    <span>{{ $semester->semester_name }} Semester</span>
                </h5>
                <div class="d-flex justify-content-between">
                    &nbsp;
                    <form action="{{ route('classroom.create') }}" class="" method="GET">
                        @csrf
                        <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                        <input type="hidden" name="semester_id" value="{{ $semester->id }}">
                        <input type="hidden" name="course_id" value="{{ $batch->course->id }}">
                        <button type="submit" class="btn btn-success" style="border-radius: 50%;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
                <?php $i=0; ?>
                @foreach ($semester->subjects as $subject)
                    @foreach ($subject->batch_classrooms($batch->id)->get() as $classroom)
                        <div class="col-md-3 mb-3 mt-3" style="width: 20rem;">
                            <div class="card shadow p-0" style="height: 350px; position: relative;">
                                <img src="{{ asset('images/background/'.$classroom->image) }}" class="card-img-top" style="object-fit:contain;">
                                <div class="profile" style="position: absolute; top: 132px; right: 10px;">
                                    @foreach ($classroom->teachers as $teacher)
                                        <img src="{{ asset('images/profile/'. $teacher->user->avatar) }}" style="width: 60px; border-radius: 50%; ">
                                    @endforeach
                                </div>
                                <div class="card-body">
                                    <div class="mb-1" style="margin-top: -15px;">
                                        @if ($classroom->is_active)
                                            <span class="badge bg-primary">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </div>
                                    <div class="mb-1" style="height: 30px;">
                                        <a href="{{ route('classroom.show', $classroom->id) }}" style=" text-decoration: none; font-weight:bold; width: 80%">
                                            {{ $classroom->room_name }}
                                        </a>
                                    </div>
                                    <div class="mb-2 d-flex" style="height: 30px;">
                                        <h5 class="card-title me-2" style="font-size: 0.9rem;"> <b>Subject</b> </h5> <h6>{{ $subject->subject_name }}</h6>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between align-items-baseline">
                                        <h6 class=" text-muted ">Batch {{ $batch->batch_name }}</h6>
                                        <p class="card-text">{{ $batch->course->courseDetails->slug }}</p>
                                    </div>

                                </div>
                                <div class="bottom-element w-100">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('classroom.edit', $classroom->id) }}" class="btn btn-default">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('classroom.destroy', $classroom->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" href="{{ route('classroom.destroy', $classroom->id) }}" class="btn btn-default">
                                                <i class="fas fa-trash"></i>
                                            </button type="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                @endforeach
                @if ($i==0)
                    <div class="row p-4">
                            <h5 class="text-center fw-bold text-danger">No Classroom Found</h5>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
