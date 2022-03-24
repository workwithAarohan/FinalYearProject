@extends('layouts.nav')

@section('style')
    <style>
        .tab-button
        {
            border: none;
            background: transparent;
            color: #130d49;
            font-size: 19px;
            font-weight: 600;
        }

        .tab-button.active:after
        {
            content: "";
            display: block;
            width: auto;
            padding-top: 0px;
            border-bottom: 2px solid black;
        }

        .member-list:hover
        {
            background: rgba(0, 0, 0, 0.082);
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-3">
        <div class="row mb-4 justify-content-around" style="column-gap: 20px;">
            <div class="col-md-4 bg-white shadow rounded p-0" style="position: relative; height: 480px;">
                <h5 class="bg-primary text-center p-2 text-white">{{ $classroom->room_name }}</h5>

                <div class="image">
                    <img src="{{ asset('images/background/'.$classroom->image) }}" class="w-100" style="margin-top: -8px; height: 180px; object-fit:cover;
                    object-position:50% 50%; opacity: 0.7;">
                </div>

                <div class="desc-body mb-4 mt-4">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style=" position: absolute; top: 190px; left: 120px;">
                        <li class="nav-item" role="presentation">
                          <button class="tab-button active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">About</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="tab-button" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Description</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="mb-2 d-flex justify-content-center" style="height: 30px;">
                                <h5 class="card-title me-2" style="font-size: 0.9rem;"> <b>Subject</b> </h5> <h6>{{ $classroom->subject->subject_name }}</h6>
                            </div>
                            <div class="mb-2 d-flex justify-content-around" style="margin-top: -15px;">
                                <div class="card" style="width:15rem; border: none;">
                                    <div class="card-body">
                                        <h5 class="fs-6 fw-bold text-center">Course Completed ({{ $courseCompleted }}%)</h5>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $courseCompleted }}%" aria-valuenow="{{ $courseCompleted }}" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 d-flex justify-content-around align-items-baseline">
                                <h6 class=" text-muted ">Batch {{ $classroom->batch->batch_name }}</h6>
                                <p class="card-text">{{ $classroom->batch->course->courseDetails->slug }}</p>
                            </div>

                            <div class="mb-2 d-flex justify-content-around ">
                                <p class="card-text"><b>Assignments: </b>{{ $classroom->assignments->count() }}</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="mb-5 px-3" style="height: 30px;">
                                <p class="fs-6">
                                    {{ $classroom->description }}
                                </p>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="desc-footer w-100 p-2 " style="position: absolute; bottom: 0px; border-top: 2px solid #382d2d;">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-baseline pb-0">
                            <h5 class="fs-6 fw-bold">
                                Created by :
                            </h5> &nbsp;
                            <p>{{ $classroom->createdBy->firstname }}</p>
                        </div>

                        <div>
                            <form action="{{ route('classroom.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="classroom_id" value="{{ $classroom->id}}">

                                <button type="submit" class="show_confirm" data-toggle="tooltip" style="background: transparent; border: none;" >
                                    @if ($classroom->is_active)
                                        <span class="badge bg-primary">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 bg-white p-4 shadow rounded">

                {{-- Teacher Section --}}
                <div class="p-1 d-flex justify-content-between align-items-baseline" style="border-bottom: 2px solid #0078D4">
                    <div class="d-flex ">
                        <h3 class="text-primary">
                            Teachers
                        </h3>
                        <p class="ms-3 mt-1">
                            <span class=" text-white my-auto" id="countTeacher" style="background: #07a83d; border-radius: 50%; padding: 4px 8px; font-size: 15px;">{{ $classroom->teachers->count() }}</span>
                        </p>
                    </div>

                    <div class="fs-4">
                        <button type="button" class=" fs-4" data-bs-toggle="modal" data-bs-target="#addTeacher" style="background: transparent; border: none;">
                            <i class="fas fa-user-plus text-primary"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="addTeacher" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="selectCourse">Add Teachers to Classroom</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if(session('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @foreach ($eligibleTeachers as $teacher)
                                            <hr>
                                            <div class=" p-1 d-flex justify-content-between align-items-center">
                                                <div class="profile d-flex">
                                                    <div class="image me-4">
                                                        <img src="{{ asset('images/profile/'. $teacher->user->avatar) }}" style="width: 50px; border-radius: 50%" class="bg-dark">
                                                    </div>
                                                    <div class="teacherInfo">
                                                        <a href="" class="fw-bold fs-6 text-decoration-none">{{ $teacher->user->firstname }} {{ $teacher->user->lastname }}</a>
                                                        <p class="text-muted fs-6" style="">{{ $teacher->user->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="add">

                                                    @if ($teacher->isAdded)
                                                        <button class="btn btn-default border" disabled>
                                                            <i class="fas fa-check"></i> Added
                                                        </button>
                                                    @else
                                                        <form action="{{ route('classroom.addTeachers') }}" method="POST" id="formTeacher">
                                                            @csrf
                                                            <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                                            <button class="btn btn-primary" type="submit" id="formTeacherSubmit">
                                                                Add
                                                            </button>
                                                            <button class="btn border" type="submit" style="background: #ffffff; display: none;" id="addedTeacherButton" disabled>
                                                                <span>
                                                                    <i class="fas fa-check"></i> Added
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="teachers">
                    @foreach ($classroom->teachers as $teacher)
                        <div class="member-list p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex w-50 align-items-center">
                                <div class="image me-2">
                                    <img src="{{ asset('images/profile/'.$teacher->user->avatar) }}" style="width: 45px; border-radius: 50%;">
                                </div>
                                <div class="teacherInfo">
                                    <a href="" class="text-decoration-none text-black fw-bold" style="font-size: 13px;">
                                        {{ $teacher->user->firstname }} {{ $teacher->user->lastname }}
                                    </a>
                                </div>
                            </div>
                            <div class="delete-button" style="display: none;">
                                <form action="{{ route('classroom.removeTeacher', $teacher->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button style="background: transparent; border:none;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr class="m-0">
                    @endforeach
                </div>

                {{-- Student Section --}}
                <div class="p-1 mt-2 d-flex justify-content-between align-items-baseline" style="border-bottom: 2px solid #0078D4">
                    <div class="d-flex ">
                        <h3 class="text-primary">
                            Students
                        </h3>
                        <p class="ms-3 mt-1">
                            <span class=" text-white my-auto" id="countStudent" style="background: #07a83d; border-radius: 50%; padding: 4px 8px; font-size: 15px;">{{ $classroom->students->count() }}</span>
                        </p>
                    </div>


                    <div class="d-flex align-items-baseline">

                        <button type="button" class=" fs-4" data-bs-toggle="modal" data-bs-target="#addStudent"  style="background: transparent; border: none;">
                            <i class="fas fa-user-plus text-primary"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addStudent" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="selectCourse">Add Students to Classroom</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($eligibleStudents as $student)
                                            <hr>
                                            <div class=" p-1 d-flex justify-content-between align-items-center">
                                                <div class="profile d-flex align-items-center">
                                                    <div class="image me-4">
                                                        <img src="{{ asset('images/profile/'. $student->user->avatar) }}" style="width: 50px; border-radius: 50%" class="bg-dark">
                                                    </div>
                                                    <div class="studentInfo mt-2">
                                                        <a href="" class="fw-bold fs-6 text-decoration-none">{{ $student->user->firstname }} {{ $student->user->lastname }}</a>
                                                        <p class="text-muted" style="">{{ $student->college_email }}</p>
                                                    </div>
                                                </div>
                                                <div class="add">
                                                    @if ($student->isAdded)
                                                        <button class="btn btn-default border" disabled>
                                                            <i class="fas fa-check"></i> Added
                                                        </button>
                                                    @else
                                                        <form action="{{ route('classroom.addStudents') }}" method="POST" id="formStudent">
                                                            @csrf

                                                            <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                            <button class="btn btn-primary" type="submit" id="formStudentSubmit">
                                                                Add
                                                            </button>
                                                            <button class="btn border" type="submit" style="background: #ffffff; display: none;" id="addedStudentButton" disabled>
                                                                <span>
                                                                    <i class="fas fa-check"></i> Added
                                                                </span>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="students">
                    @foreach ($classroom->students as $student)
                        <div class="member-list p-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex w-50 align-items-center">
                                <div class="image me-2">
                                    <img src="{{ asset('images/profile/'.$student->user->avatar) }}" style="width: 60px; height: 60px; border-radius: 50%;">
                                </div>
                                <div class="studentInfo">
                                    <a href="" class="text-decoration-none text-black fw-bold member-link" style="font-size: 13px;">
                                        {{ $student->user->firstname }} {{ $student->user->lastname }}
                                    </a>
                                    <p>{{ $student->symbol_number }}</p>
                                </div>
                            </div>
                            <div class="delete-button" style="display: none;">
                                <form action="{{ route('classroom.removeStudent', $student->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button style="background: transparent; border:none;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <hr class="m-0">
                    @endforeach
                </div>

            </div>


        </div>

    </div>

    <script>
        $(document).ready(function(){
            $('#formTeacher').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{ route('classroom.addTeachers') }}',
                    data: $('#formTeacher').serialize(),
                    type: 'post',
                    success: function(response){
                        if(response)
                        {
                            $('#formTeacherSubmit').hide();
                            $('#addedTeacherButton').show();

                            var count = $('#countTeacher').text();
                            count = parseInt(count) + 1;
                            $('#countTeacher').text(count);

                            $('#teachers').append('<div class="member-list p-3 d-flex justify-content-between align-items-center"><div class="d-flex w-50 align-items-center"><div class="image me-2"><img src="/images/profile/'+ response.avatar +'" style="width: 45px; border-radius: 50%;"></div><div class="teacherInfo"><a href="" class="text-decoration-none text-black fw-bold" style="font-size: 13px;">'+ response.firstname + ' ' + response.lastname + '</a></div></div><div class="delete-button" style="display: none;"><div class="btn"><i class="fas fa-trash"></i></div></div></div><hr class="m-0">');
                        }
                    }
                });
            });
            $('#formStudent').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{ route('classroom.addStudents') }}',
                    data: $('#formStudent').serialize(),
                    type: 'post',
                    success: function(response){
                        if(response)
                        {
                            $('#formStudentSubmit').hide();
                            $('#addedStudentButton').show();

                            var count = $('#countStudent').text();
                            count = parseInt(count) + 1;
                            $('#countStudent').text(count);

                            $('#students').append('<div class="member-list p-3 d-flex justify-content-between align-items-center"><div class="d-flex w-50 align-items-center"><div class="image me-2"><img src="/images/profile/'+ response.avatar +'" style="width: 45px; border-radius: 50%;"></div><div class="studentInfo"><a href="" class="text-decoration-none text-black fw-bold" style="font-size: 13px;">'+ response.firstname + ' ' + response.lastname + '</a></div></div><div class="delete-button" style="display: none;"><div class="btn"><i class="fas fa-trash"></i></div></div></div><hr class="mt-0">');
                        }
                    }
                });
            });


            $('.member-list').hover(function(e){
                $(this).find('.delete-button').show();
            }, function(e){
                $(this).find('.delete-button').hide();
            });
        });
    </script>
@endsection
