@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow" style="padding: 10px 40px; ">
                    <table class="table table-hover" style="font-size:small;">
                        <thead>
                            <tr>
                                <th scope="col">Roll No</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Points</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignment->student_points as $studentWork)
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
