@extends('layouts.common')

@section('title')
    Students - All
@endsection

@section('style')
    tr[data-href]
    {
        cursor: pointer;
    }
@endsection

@section('content')
    <div class="container">
        <h4>Students</h4>

        <form action="{{ route('students.list') }}" method="GET">
            @csrf

            <div class="row ps-5">
                <div class="d-flex" >
                    <div class="me-3">
                        <label for="course" class="form-label" style="">Course</label><br>
                        <select name="course_id" id="course" class="form-input" style="width: 165px;" id="course">
                            <option selected="selected" disabled>Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->courseDetails->slug }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="me-3">
                        <label for="batch" class="form-label" style="">Batch</label><br>
                        <select name="batch_id" id="batch" class="form-input" style="width: 165px;">
                            <option selected="selected" disabled>Select Course First</option>
                        </select>
                    </div>

                    <div class="me-3 mt-auto">
                        <button type="submit" style="background: transparent; ">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="row mt-5 mx-3">
            <div class="card shadow" style="padding: 10px 40px; ">
                @if (count($students) != 0)

                    <h4>{{ $faculty->courseDetails->slug }} - Batch {{ $batch->batch_name }}</h4>
                    <table class="table table-hover" style="font-size:small;">
                        <thead>
                            <tr>
                                <th scope="col">Symbol Number</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($students as $student)
                                <tr data-href="{{ route('student.performance', $student->id) }}">
                                    <th scope="row">{{ $student->symbol_number }}</th>

                                    <th scope="row">
                                        {{ $student->user->firstname }} {{ $student->user->lastname }}
                                    </th>
                                    <td>
                                        {{ $student->semester->semester_name }}
                                    </td>
                                    <td>
                                        @if ($course->is_active)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-around py-5">
                        <h4 class="fw-bold">No record found</h4>
                    </div>
                @endif

                {{-- {{ $courses->links() }} --}}
            </div>
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
                url: '/admin/select-batch/' + course,
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
