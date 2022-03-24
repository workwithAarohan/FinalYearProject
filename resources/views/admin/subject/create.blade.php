@extends('layouts.common')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 border p-4">

                <form action="{{ route('subject.store') }}" method="POST">
                    @csrf
                    <h3>Add Subject</h3>
                    <label for="">Subject:</label> <br>
                    <input type="text" name="subject_code" placeholder="Code" style="width: 80px;"> -
                    <input type="text" name="subject_name" placeholder="Subject Name"> <br> <br>

                    <label for="credit_hrs">
                        Credit Hours:
                    </label>
                    <input type="text" name="credit_hrs" id="credit_hrs"> <br> <br>

                    <label for="is_elective">
                        Subject Type:
                    </label>
                    <input type="radio" name="is_elective" id="is_elective" value="0" checked>
                    <label for="is_elective">Compulsory</label>
                    <input type="radio" name="is_elective" id="is_elective" value="1" class="ms-3">
                    <label for="is_elective">Elective</label> <br> <br>

                    <label for="syllabus">
                        Syllabus:
                    </label>
                    <input type="text" name="syllabus"> <br> <br>

                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <label for="semester_id">Semester</label>
                    <select name="semester_id" id="semester_id">
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}">{{ $semester->semester_name }}</option>
                        @endforeach
                    </select>

                    <br><br>


                    <button type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>

@endsection
