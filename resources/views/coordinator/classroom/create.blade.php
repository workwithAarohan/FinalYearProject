@extends('layouts.nav')

@section('content')
    <div class="container mt-2">
        <form action="{{ route('classroom.store') }}" method="POST" class="" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center border bg-white p-0" style="column-gap: 20px;">
                <h4 class="bg-primary text-white p-2 text-center">Create Classroom</h4>
                <div class="col-md-6 mt-4">
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
                </div>

                <div class="col-md-5 mt-4">
                    <div class="mb-3">
                        <label for="description" class="form-label">Classroom Description</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label for="main_checkbox" class="form-label">Add Students</label>
                            <div>
                                <input type="checkbox" name="main_checkbox" id="all_checkbox" class=""> Add all Students
                            </div>
                        </div>
                        <div class="border p-3" style="height: 220px; overflow-y:auto;">
                            @foreach ($eligibleStudents as $student)
                                <div class="align-items-center">
                                    <input type="checkbox" name="students[]" id="" value="{{ $student->id }}">
                                    <label for="" class="form-label ms-2">
                                        <img src="{{ asset('images/profile/'.$student->user->avatar) }}" style="width: 50px; border-radius: 50%;">
                                        {{ $student->user->firstname }} {{ $student->user->lastname }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="form-control btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).on('click', '#all_checkbox', function()
        {
            if(this.checked)
            {
                $('input[name="students[]"]').each(function(){
                    this.checked = true;
                });
            }
            else
            {
                $('input[name="students[]"]').each(function(){
                    this.checked = false;
                });
            }
        });

        $(document).on('change', 'input[name="students[]"]', function()
        {
            if($('input[name="students[]"]').length == $('input[name="students[]"]:checked').length)
            {
                $('#all_checkbox').prop('checked', true);
            }
            else
            {
                $('#all_checkbox').prop('checked', false);
            }
        });


    </script>
@endsection
