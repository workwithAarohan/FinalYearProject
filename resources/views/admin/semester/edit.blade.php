@extends('layouts.nav')

@section('content')
    <form action="{{ route('semester.update', $semester->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Semester Name: </label>
        <input type="text" name="semester_name" value="{{ $semester->semester_name }}"> <br> <br>
        <label for="description">Description: </label> <br>
        <textarea name="description" id="description" cols="50" rows="5">{{ $semester->description }}
        </textarea> <br><br>

        <button type="submit">Edit</button>
    </form>
@endsection
