@extends('layouts.nav')

@section('style')
    <style>

        #topic_covered
        {
            width: 500px;
            background: transparent;
            border-color: #a5a6a8;
            border-style: none none solid none;
            transition: all .5s;

        }

        #topic_covered:focus
        {
            outline:none;
            border-color: #3241c7;
        }

        #topic_covered::placeholder
        {
            font-size: 18px;
            color: #000;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-between align-items-baseline">
                <h5>{{ $classroom->room_name }}</h5>
                <button class="mb-3" style="border-radius: 5px; color: white; background: #3a7fdf; padding: 10px 20px; border: none;" data-bs-toggle="modal" data-bs-target="#attendanceAdd">
                    Take Attendance
                </button>
                <!-- Modal -->
                <div class="modal" id="attendanceAdd" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <form action="{{ route('attendance.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="attendance_date" value="{{ date('Y-m-d h:i:s') }}" >

                                <div class="modal-header d-flex justify-content-between">
                                    <div class="heading d-flex align-items-baseline">
                                        <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <h5 class="modal-title" id="selectCourse">Attendance</h5>
                                    </div>
                                    <div class="topic_input">
                                        <input type="text" id="topic_covered" name="topic_covered" class="@error('username') is-invalid @enderror" placeholder="Topic Covered" autofocus>
                                    </div>
                                    <input type="submit" class="text-white fw-bold" value="Save" style="background: #3a7fdf; border: none; padding: 5px 10px;">
                                </div>
                                <div class="modal-body ">
                                    <div class="row px-3">
                                        <div class="col-md-9 px-5 border-end" style="height: 80vh;">
                                            <table class="table" style="font-size:small;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Symbol Number</th>
                                                        <th scope="col">Student Name</th>
                                                        <th scope="col">Status</th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($classroom->students as $student)
                                                        <input type="hidden" name="students[]" value="{{ $student->id }}">
                                                        <tr>
                                                            <td>
                                                                {{ $student->symbol_number }}
                                                            </td>
                                                            <td>
                                                                {{ $student->user->firstname }} {{ $student->user->lastname }}
                                                            </td>
                                                            <td class="d-flex">

                                                                <div class="me-2">
                                                                    <input type="radio" name="status[{{ $student->id }}]" id="present" class="" value="Present"> P
                                                                </div>
                                                                <div class="me-2">
                                                                    <input type="radio" name="status[{{ $student->id }}]" id="absent" class="" value="Absent"> A
                                                                </div>
                                                                <div class="me-2">
                                                                    <input type="radio" name="status[{{ $student->id }}]" id="leave" class="" value="Leave"> L
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col px-4" style="height: 80vh;">
                                            <h5>About</h5>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" value="{{ $classroom->batch->batch_name }} - {{ $classroom->batch->course->courseDetails->slug }}" disabled style="border: none; background: transparent;">
                                            </div>
                                            <div class="mb-3">
                                                <label for="attendance_date" class="form-label">Date</label>
                                                <p>
                                                    {{ date("F d, Y") }}
                                                </p>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            @foreach ($classroom->attendances as $attendance)
                <div class="card mb-2" style="">
                  <div class="card-body d-flex justify-content-between">
                    <a href="{{ route('attendance.show', $attendance->id) }}">
                        {{ $attendance->topic_covered }}
                    </a>
                    <h5 class="card-title">
                        {{ $attendance->attendance_date }}
                    </h5>

                  </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
