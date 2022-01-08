@extends('layouts.nav')

@section('style')
    <style>
        .form-input
        {
            width: 100%;
            border: none;
            background: #F8F9FA;
            padding: 8px;
        }

        .form-input:focus
        {
            border-bottom: 2px solid #3a7fdf;
            outline: none;
        }

        .type-list
        {
            margin-top: 80px;
        }

        .type-list > .list
        {
            margin-top: 15px;
            padding: 10px;
            cursor: pointer;
            text-align: center;
        }

        .type-list > .list:hover
        {
            background: #a9c7f1d5;
            border-radius: 8px;
        }

        .list > .list-link
        {
            text-decoration: none;
            color: #a19f9f;
        }

        .list > .list-link.active
        {
            color: #2d5da1;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul class="type-list" style="list-style: none;">
                    <li class="list" style="color: #3a7fdf;">
                        <a class="list-link active" href="{{ route('assignment.index', $classroom->id) }}">Assignment</a>
                    </li>
                    <li class="list">
                        <a class="list-link" href="">Notes</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-8">
                <button class="btn mb-3" style="border-radius: 50px; color: white; background: #3a7fdf; padding: 10px 20px;" data-bs-toggle="modal" data-bs-target="#addTeacher">
                    <i class="fas fa-plus" style=""></i>
                    <span style="margin-left: 6px; font-size: 15px; font-weight: bold; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Create</span>
                </button>
                <!-- Modal -->
                <div class="modal" id="addTeacher" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">
                            <form action="{{ route('assignment.store') }}" method="POST">
                                @csrf
                                <div class="modal-header d-flex justify-content-between">
                                    <div class="heading d-flex align-items-baseline">
                                        <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <h5 class="modal-title" id="selectCourse">Assignment</h5>
                                    </div>
                                    <input type="submit" class="btn btn-primary text-white fw-bold" value="Assign">
                                </div>
                                <div class="modal-body ">
                                    <div class="row px-3">
                                        <div class="col-md-9 px-5 border-end" style="height: 80vh;">
                                            <div class="mb-3 d-flex align-items-center">
                                                <i class="fas fa-clipboard-list fs-4"></i>
                                                <input type="text" class="form-input ms-3" id="title" name="title" placeholder="Title">
                                            </div>
                                            <div class="mb-3 d-flex align-items-top">
                                                <i class="fas fa-align-left  fs-4 mt-3"></i>
                                                <textarea name="instruction" id="instruction" cols="30" rows="10" class="form-input ms-3" placeholder="Instructions"></textarea>
                                            </div>
                                        </div>
                                        <div class="col px-4" style="height: 80vh;">
                                            <div class="mb-3">
                                                <label for="batch" class="form-label">For</label>
                                                <input type="text" class="form-control" value="{{ $classroom->batch->batch_name }} - {{ $classroom->batch->course->courseDetails->slug }}" disabled>
                                            </div>
                                            <div class="mb-3 w-50">
                                                <label for="points" class="form-label">Points</label>
                                                <input type="number" id="points" class="form-control" name="points">
                                            </div>
                                            <div class="mb-3">
                                                <label for="due_date" class="form-label">Due Date</label>
                                                <input type="date" id="due_date" class="form-control" name="due_date">
                                            </div>
                                            <div class="mb-3">
                                                <label for="topic" class="form-label">Topic</label>
                                                <select name="topic_id" id="topic" class="form-select">
                                                    @foreach ($classroom->topics as $topic)
                                                        <option value="{{ $topic->id }}">{{ $topic->topic_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="section p-4 bg-white rounded mt-2">
                    <h4 class="fw-bold fs-3 text-secondary mb-3">Assignments</h4>
                    @if ($classroom->assignments->count()!=0)
                        @foreach ($classroom->topics as $topic)
                            @if ($topic->count()!=0)
                                <div class="mb-5">
                                    <div class="mb-3 p-1 d-flex justify-content-between align-items-baseline" style="border-bottom: 2px solid #0078D4">
                                        <h3 class="text-primary">
                                            {{ $topic->topic_title }}
                                        </h3>
                                    </div>
                                    @if ($topic->assignments->count()!=0)
                                        @foreach ($topic->assignments as $assignment)
                                            <div class="assign-list d-flex justify-content-between align-items-center mb-3">
                                                <div class="d-flex align-items-center ">
                                                    <i class="fas fa-clipboard-list fs-4" style="background: #3a7fdf; color: #fff; border-radius: 50%; padding: 10px;"></i>
                                                    <a href="{{ route('assignment.show', $assignment->id) }}" class="fw-bold ms-3 text-dark text-decoration-none">{{ $assignment->title }}</a>
                                                </div>
                                                <div class="d-flex align-items-baseline">
                                                    <p class="me-3">Posted {{ $assignment->created_at->toFormattedDateString() }}</p>
                                                    <div class="dropdown">
                                                        <button class="btn btn-default" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                            <li>
                                                                <a href="{{ route('assignment.edit',$assignment->id) }}" class="me-3 text-decoration-none dropdown-item" title="Edit">
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST" class="dropdown-item">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="p-0 btn" title="Delete">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @else
                                        <div class="d-flex justify-content-around">
                                            <h4 class="fs-6 mb-3">Students will see this topic once work is added to it</h4>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @else
                         <div class="d-flex justify-content-around">
                             <h4 class="fw-bold fs-4 text-danger mb-3">No Assignment</h4>
                         </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
