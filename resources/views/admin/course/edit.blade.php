@extends('layouts.nav')

@section('content')
    <form action="{{ route('course.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <h3>
            Edit Course Details
        </h3>
        <label for="course_name">Course Name: </label>
        <input type="text" name="course_name" id="course_id" value="{{ $course->course_name }}" style="width: 500px;"> <br> <br>
        <label for="slug">Course Slug: </label>
        <input type="text" name="slug" value="{{ $course->courseDetails->slug }}" style="width: 500px;"> <br> <br>
        <label for="title">Course Title: </label>
        <input type="text" name="title" value="{{ $course->courseDetails->title }}" style="width: 500px;"> <br> <br>
        <label for="image">Image </label>
        <input type="text" name="image" value="{{ $course->courseDetails->image }}" style="width: 500px;"> <br> <br>
        <label for="description">Description: </label> <br>
        <textarea name="description" id="description" cols="50" rows="5">{{ $course->courseDetails->description }}
        </textarea> <br><br>
        <label for="objective">Objective: </label> <br>
        <textarea name="objective" id="objective" cols="50" rows="5">{{ $course->courseDetails->objective }}
        </textarea> <br><br>

        <button type="submit">Edit</button>
    </form>
@endsection


