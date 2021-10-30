@extends('layouts.nav')

@section('content')
    <form action="{{ route('semester.store') }}" method="POST">
        @csrf
        <label for="semester_name">
            Semester Name:
        </label>
        <input type="text" name="semester_name"> <br> <br>

        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

        <label for="description">Description: </label> <br>
        <textarea name="description" id="description" cols="50" rows="5"></textarea> <br>

        <button type="submit">Create</button>
    </form>
@endsection
