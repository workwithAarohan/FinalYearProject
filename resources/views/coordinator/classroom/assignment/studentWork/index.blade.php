@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row">
            <h4 class=" fs-2" style="color: #0d3cac;">
                {{ $assignment->title }}
            </h4>
            <div class="col-md-8">
                <div class="card shadow" style="padding: 10px 40px; ">
                    <table class="table table-hover" style="font-size:small;">
                        {{-- <thead>
                            <tr>
                                <th scope="col">Roll No</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Points</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @foreach ($assignment->student_points as $studentWork)
                                {{-- <tr data-href="">
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
                                            <i>Returned</i>
                                        @else
                                            <form action="">
                                                <input type="hidden" name="">
                                            </form>
                                        @endif
                                    </td>
                                </tr> --}}

                                <div class="d-flex ">
                                    <div class="image me-2">
                                        <img src="{{ asset('images/profile/'. $studentWork->student->user->avatar) }}" style="width: 40px; border-radius: 50%;" class="" alt="avatar">
                                    </div>
                                    <div class="studentInfo">
                                        <a href="" class="me-3" style="text-decoration: none; font-weight: bold; color: #000; font-size: 13px;">{{ $studentWork->student->user->firstname }} {{ $studentWork->student->user->lastname }}</a>
                                        <p style="font-size: 12px;">
                                            {{ $studentWork->student->symbol_number }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
