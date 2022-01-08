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

        body
        {
            background: #fff;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="margin-top: -24px;">
        <form action="{{ route('assignment.update', $assignment->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header d-flex justify-content-between">
                <div class="heading d-flex align-items-baseline">
                    <h5 class="modal-title" id="selectCourse">Assignment</h5>
                </div>
                <input type="submit" class="btn btn-primary text-white fw-bold" value="Save">
            </div>
            <div class="modal-body ">
                <div class="row px-3">
                    <div class="col-md-9 px-5 border-end" style="">
                        <div class="mb-3 d-flex align-items-center">
                            <i class="fas fa-clipboard-list fs-4"></i>
                            <input type="text" class="form-input ms-3" id="title" name="title" placeholder="Title" value="{{ $assignment->title }}">
                        </div>
                        <div class="mb-3 d-flex align-items-top">
                            <i class="fas fa-align-left  fs-4 mt-3"></i>
                            <textarea name="instruction" id="instruction" cols="30" rows="10" class="form-input ms-3" placeholder="Instructions">{{ $assignment->instruction }}</textarea>
                        </div>
                    </div>
                    <div class="col px-4" style="">
                        <div class="mb-3">
                            <label for="batch" class="form-label">For</label>
                            <input type="text" class="form-control" value="{{ $assignment->classroom->batch->batch_name }} - {{ $assignment->classroom->batch->course->courseDetails->slug }}" disabled>
                        </div>
                        <div class="mb-3 w-50">
                            <label for="points" class="form-label">Points</label>
                            <input type="number" id="points" class="form-control" name="points" value="{{ $assignment->points }}">
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" id="due_date" class="form-control" name="due_date" value="{{ $assignment->due_date }}">
                        </div>
                        <div class="mb-3">
                            <label for="topic" class="form-label">Topic</label>
                            <select name="topic_id" id="topic" class="form-select">
                                @foreach ($assignment->classroom->topics as $topic)
                                    @if ($assignment->topic_id == $topic->id)
                                        <option value="{{ $topic->id }}" selected>{{ $topic->topic_title }}</option>
                                    @else
                                        <option value="{{ $topic->id }}">{{ $topic->topic_title }}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="classroom_id" value="{{ $assignment->classroom_id }}">
                        <input type="hidden" name="created_by" value="{{ $assignment->created_by }}">
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
