@extends('layouts.common')

@section('title')
    Examination
@endsection

@section('style')
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
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert" style="background: #ff7866;">
                <strong>Error!!!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @role('Coordinator')
            <button class="btn mb-3 float-end" style="border-radius: 50px; color: white; background: #3a7fdf; padding: 10px 20px;" data-bs-toggle="modal" data-bs-target="#addExamination">
                <i class="fas fa-plus" style=""></i>
                <span style="margin-left: 6px; font-size: 15px; font-weight: bold; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">Create</span>
            </button>
            <!-- Modal -->
            <div class="modal" id="addExamination" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <form action="{{ route('examination.store') }}" method="POST">
                            @csrf
                            <div class="modal-header d-flex justify-content-between">
                                <div class="heading d-flex align-items-baseline">
                                    <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h5 class="modal-title" id="selectCourse">Examination</h5>
                                </div>
                                <input type="submit" class="btn btn-primary text-white fw-bold" value="Submit">
                            </div>
                            <div class="modal-body ">
                                <div class="row px-3">
                                    <div class="col-md-9 px-5 border-end" style="height: 80vh;">
                                        <div class="mb-3 d-flex align-items-center">
                                            <i class="fas fa-clipboard-list fs-4"></i>
                                            <input type="text" class="form-input ms-3" id="title" name="exam_title" placeholder="Examination Title">
                                        </div>
                                        <div class="mb-3 d-flex align-items-top">
                                            <i class="fas fa-align-left  fs-4 mt-3"></i>
                                            <textarea name="instruction" id="instruction" cols="30" rows="10" class="form-input ms-3" placeholder="Instructions"></textarea>
                                        </div>
                                    </div>

                                    <div class="col px-4" style="height: 80vh;">

                                        <div class="d-flex mb-3">
                                            <div class="me-2">
                                                <label for="course" class="form-label" style="">Course</label><br>
                                                <select name="course_id" id="course" class="form-select" style="width: 140px;" id="course">
                                                    <option selected="selected" disabled>Select Course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">
                                                            {{ $course->courseDetails->slug }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="">
                                                <label for="batch" class="form-label" style="">Batch</label><br>
                                                <select name="batch_id" id="batch" class="form-select" style="width: 170px;">
                                                    <option selected="selected" disabled>Select Course First</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="semester" class="form-label">Semester</label>
                                            <select name="semester_id" id="semester" class="form-select">
                                                <option value="" selected="selected" disabled>Choose Semester</option>
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 w-50">
                                            <label for="exam_year" class="form-label">Exam Year</label>
                                            <input type="text" id="exam_year" class="form-control" name="exam_year">
                                        </div>
                                        <div class="d-flex">
                                            <div class="mb-3 me-2">
                                                <label for="start_time" class="form-label">Start Time</label>
                                                <input type="time" id="start_date" class="form-control" name="start_time" style="width: 155px;">
                                            </div>
                                            <div class="mb-3">
                                                <label for="end_time" class="form-label">End Time</label>
                                                <input type="time" id="end_date" class="form-control" name="end_time" style="width: 155px;">
                                            </div>
                                        </div>

                                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endrole
        <h5 class="text-center" style="font-size: 24px; font-weight: bold;">Examination</h5>
        <div class="row mt-4 ms-5">
            @foreach ($examination as $value)
                <p style="font-weight: bold;">{{ $value->created_at->format('M d, Y') }}</p>
                <div class="card shadow py-3 px-4 mb-4" style="width: 600px;">
                    <div class="d-flex mb-2 justify-content-between align-items-baseline">
                        <div>
                            <i class="fas fa-clipboard-list me-3" style="font-size: 25px;"></i>
                            <a href="{{ route('examination.show', $value->id) }}" style="font-size: 16px; font-weight: bold; text-decoration: none; color: #000;">{{ $value->exam_title }}</a>
                        </div>
                        <div>
                            <p style="margin:0;">{{ $value->start_time }} - {{ $value->end_time }}</p>
                            <p style="font-size: 12px; text-align:center;">(Start Time - End Time)</p>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p style="margin-top: -30px;">{{ $value->course->courseDetails->slug }} (Batch - {{ $value->batch->batch_name }})</p>
                            <p style="margin-top: -16px; margin-bottom: 0;">{{ $value->semester->semester_name }} Semester</p>
                        </div>
                        <div>
                            @if ($value->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-danger">Not Published</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    document.addEventListener('DOMContentLoaded',() => {
        const rows = document.querySelectorAll("tr[data-href]");

        rows.forEach(row => {
            row.addEventListener("click", () => {
                window.location.href = row.dataset.href;
            });
        });
    });
    $('#course').on('change', function(){
        var course = $(this).val();

        console.log(course);

        if(course)
        {
            $.ajax({
                url: '/coordinator/select-batch/' + course,
                type:'GET',
                data: {'_token':'{{ csrf_token() }}'},
                dataType: 'json',
                success:function(data)
                {
                    if(data)
                    {
                        console.log(data);
                        $('#batch').empty();

                        $('#batch').append('<option selected="selected" disabled>Choose Batch</option>');
                        $.each(data, function(key, batch)
                        {
                            console.log(batch.id);
                            $('select[name="batch_id"]').append('<option value="'+ batch.id +'">'+  batch.batch_name +'</option>');
                        });
                    }
                    else
                    {
                        $('#batch').empty();
                    }
                }
            });
        }
    });
@endsection

