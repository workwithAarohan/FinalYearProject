@extends('layouts.nav')

@section('content')
    <form action="{{ route('course.store') }}" method="POST">
        @csrf
        <label for="course_name">
            Course Name:
        </label>
        <input type="text" name="course_name"> <br> <br>


        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

        <label for="course_name">
            Course Slug:
        </label>
        <input type="text" name="slug"> <br> <br>

        <label for="course_name">
            Course Title:
        </label>
        <input type="text" name="title"> <br> <br>

        <label for="course_name">
            Course Image:
        </label>
        <input type="text" name="image"> <br> <br>

        <label for="description">Description: </label> <br>
        <textarea name="description" id="description" cols="50" rows="5"></textarea> <br>

        <label for="objective">Objective: </label> <br>
        <textarea name="objective" id="objective" cols="50" rows="5"></textarea> <br>

        <button type="submit">Create</button>
    </form>
@endsection
