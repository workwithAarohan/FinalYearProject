{{-- @extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row">
            <h4 class=" fs-2" style="color: #0d3cac;">
                {{ $assignment->title }}
            </h4>
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
                                            <i>Returned</i>
                                        @else
                                            <form action="">
                                                <input type="hidden" name="">
                                            </form>
                                        @endif
                                    </td>
                                </tr>

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
@endsection --}}

@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row bg-white p-3">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <h4 class=" fs-2" style="color: #0d3cac;">
                        {{ $assignment->title }}
                    </h4>
                </div>
                <div class="col-md-3">
                    <div class="d-flex mt-0">
                        <div class="checked me-3 text-center">
                            <h5 style="font-size: 24px;">
                                {{ $assignment->classroom->students->count() }}
                            </h5>
                            <p class="muted" style="font-size: 13px; margin-top: -10px;">Students</p>
                        </div>
                        <div class="vr me-3" style="height: 50px; width: 2px;"></div>
                        <div class="checked me-3 text-center">
                            <h5 style="font-size: 24px;">
                                {{ $checkedCount }}
                            </h5>
                            <p class="muted" style="font-size: 13px; margin-top: -10px;">Checked</p>
                        </div>
                        <div class="vr me-3" style="height: 50px; width: 3px;"></div>
                        <div class="returned text-center">
                            <h5 style="font-size: 24px;">
                                {{ $assignment->student_points->where('is_returned',1)->count() }}
                            </h5>
                            <p class="muted" style="font-size: 13px; margin-top: -10px;">Turned In</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-between mt-3">
                <div class="col-md-6">
    
                </div>
                <div class="col-md-4 shadow p-3 align-center">
                    <h4 class=" fs-4" style="color: #0d3cac;">
                        Marks Evaluation
                    </h4>
                    <table style="width: 300px;" class="mt-3">
                        <tr>
                            <th>Student Name</th>
                            <th>Marks</th>
                        </tr>
                        <form action="{{ route('assignment.marksEvaluation') }}" method="POST">
                            @csrf
                            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                            @foreach ($assignment->students as $student)
                            <input type="hidden" name="students[{{ $student->id }}]" value="{{ $student->id }}">
                                <tr>
                                    <td>
                                        {{ $student->user->firstname }} {{ $student->user->lastname }}
                                    </td>
                                    <td class="d-flex align-items-baseline">
                                        <input type="text" class="form-control" name="points_obtained[{{ $student->id}}]" value="{{ $student->pivot->points_obtained }}" style="width: 60px;">
                                        <p class="ms-2 fs-5">/ {{ $assignment->points }}</p>
                                        @if ($student->pivot->is_checked)
                                            <i class="fas fa-check" style=" padding: 8px; border-radius: 50%; color: #04b13e;"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
    
                            <tr>
                                <td>
                                    <div class="mb-3 px-4">
                                        <button type="submit" style="border: none; background: #ddd; border-radius: 5px; padding: 8px 16px;">Submit</button>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
