@extends('layouts.nav')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 border bg-white p-0">
                <h4 class="bg-primary text-white p-2">Edit Classroom - {{ $classroom->room_name }}</h4>
                <form action="{{ route('classroom.update', $classroom->id) }}" method="POST" class="p-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="created_by" value="{{ $classroom->created_by }}">

                    <div class="mb-3">
                        <label for="room_name" class="form-label">Classroom Name</label>
                        <input type="text" class="form-control" name="room_name" value="{{ $classroom->room_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Course</label>
                        <input type="text" value="{{ $classroom->batch->course->course_name }}" class="form-control" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="room_name" class="form-label">Background</label>
                        <input type="file" class="form-control" name="image" value="{{ $classroom->image }}">
                    </div>

                    <div class="mb-3">
                        <label for="created_by" class="form-label">Created By</label>
                        <input type="text" value="{{ $classroom->createdBy->firstname }} {{ $classroom->createdBy->lastname }}" class="form-control" disabled>
                        <input type="hidden" name="created_by" value="{{ $classroom->created_by }}">
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <div class="" style="width: 45%">
                            <label for="batch" class="form-label">Batch</label>
                            <input type="text" value="{{ $classroom->batch->batch_name }}" class="form-control" disabled>
                            <input type="hidden" name="batch_id" value="{{ $classroom->batch_id }}">
                        </div>

                        <div class="" style="width: 45%">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" value="{{ $classroom->subject->semester->semester_name }}" class="form-control" disabled>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" value="{{ $classroom->subject->subject_name }}" class="form-control" disabled>
                        <input type="hidden" name="subject_id" value="{{ $classroom->subject_id }}">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Classroom Description</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $classroom->description }}
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="form-control btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
