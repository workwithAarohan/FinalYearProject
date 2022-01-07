@extends('layouts.nav')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6 border bg-white p-0">
                <h4 class="bg-primary text-white p-2">Create Classroom</h4>
                <form action="{{ route('classroom.store') }}" method="POST" class="p-4" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                    <div class="mb-3">
                        <label for="room_name" class="form-label">Classroom Name</label>
                        <input type="text" class="form-control" name="room_name">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Course</label>
                        <input type="text" value="{{ $course->course_name }}" class="form-control" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="room_name" class="form-label">Background</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="mb-3 d-flex justify-content-between">
                        <div class="" style="width: 45%">
                            <label for="batch" class="form-label">Batch</label>
                            <input type="text" value="{{ $batch->batch_name }}" class="form-control" disabled>
                            <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                        </div>

                        <div class="" style="width: 45%">
                            <label for="semester" class="form-label">Semester</label>
                            <input type="text" value="{{ $semester->semester_name }}" class="form-control" disabled>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <select name="subject_id" id="subject" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Classroom Description</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="form-control btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
