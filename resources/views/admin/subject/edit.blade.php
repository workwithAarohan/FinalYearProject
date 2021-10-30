@extends('layouts.nav')

@section('content')
    <form action="{{ route('subject.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')
        <h3>Add Subject</h3>
        <label for="">Subject:</label> <br>
        <input type="text" name="subject_code" placeholder="Code" style="width: 80px;" value="{{ $subject->subject_code }}"> -
        <input type="text" name="subject_name" placeholder="Subject Name" value="{{ $subject->subject_name }}"> <br> <br>

        <label for="credit_hrs">
            Credit Hours:
        </label>
        <input type="text" name="credit_hrs" id="credit_hrs" value="{{ $subject->credit_hrs }}"> <br> <br>

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
        <input type="text" name="syllabus" value="{{ $subject->syllabus }}"> <br> <br>

        <button type="submit">Update</button>
    </form>
@endsection
