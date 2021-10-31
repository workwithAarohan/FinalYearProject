@extends('layouts.nav')


@section('content')
    Student Name: {{ $student->firstname }} {{ $student->lastname }}
@endsection