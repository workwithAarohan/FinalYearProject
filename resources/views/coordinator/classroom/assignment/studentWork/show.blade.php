@extends('layouts.nav')

@section('style')
    <style>

        .type-list
        {
            margin-top: 80px;
        }

        .type-list > .list
        {
            margin-top: 15px;
            padding: 10px;
            cursor: pointer;
            text-align: center;
        }

        .type-list > .list:hover
        {
            background: #a9c7f1d5;
            border-radius: 8px;
        }

        .list > .list-link
        {
            text-decoration: none;
            color: #a19f9f;
        }

        .list > .list-link.active
        {
            color: #2d5da1;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <ul class="type-list" style="list-style: none;">
                    <li class="list" style="color: #ffffff; background: #116deed5; border-radius: 8px;">
                        <a class="list-link" href="{{ route('classroom.dashboard', $classroom->id) }}" style="color: #ffffff;">Classroom</a>
                    </li>
                    <li class="list" style="color: #3a7fdf;">
                        <a class="list-link" href="{{ route('assignment.index', $classroom->id) }}">Assignment</a>
                    </li>
                    <li class="list">
                        <a class="list-link" href="{{ route('examination.index') }}">Examination</a>
                    </li>
                    <li class="list">
                        <a class="list-link" href="{{ route('attendance.index', $classroom->id) }}">Attendance</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-8">
                @if ($classroom->assignments->count()!=0)
                    <h5 style="font-size: 25px;">{{ $classroom->percent }}%</h5>
                    <div class="card shadow" style="padding: 10px 40px; ">
                        <table class="table table-hover" style="font-size:small;">
                            <thead>
                                <tr>
                                    <th scope="col">Assignment Title</th>
                                    <th scope="col">Topic</th>
                                    <th scope="col">Points</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classroom->assignments as $assignment)
                                    <tr>
                                        <th scope="row">{{ $assignment->title }}</th>
                                        <td>{{ $assignment->topic->topic_title }}</td>
                                        @foreach ($assignment->student_points as $student_point)
                                            @if ($student_point->student->id == auth()->user()->student->id)
                                                <td>{{ $student_point->pointsObtained }}/{{ $assignment->points }}</td>
                                                <td>
                                                    @if ($student_point->is_returned)
                                                        Returned
                                                    @else
                                                        Not Returned
                                                    @endif
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>

                                @endforeach
                                {{-- @foreach ($assignment->student_points as $studentWork)
                                    <tr data-href="">
                                        <th scope="row">{{ $studentWork->student->symbol_number }}</th>

                                        <th scope="row">
                                            {{ $studentWork->student->user->firstname }} {{ $studentWork->student->user->lastname }}
                                        </th>
                                        <td>
                                            @if ($studentWork->pointsOtained!=null)
                                                {{ $studentWork->pointsOtained }} <b>/{{ $assignment->points }}</b>
                                            @else
                                                Unchecked
                                            @endif
                                        </td>
                                        <td>
                                            @if ($studentWork->is_returned)
                                                Returned
                                            @else
                                                Not Returned
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="d-flex justify-content-around">
                        <h5>No Assignment</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
