@extends('layouts.common')

@section('title')
    Scholarship - {{ $semester->semester_name }} Semester
@endsection

@section('style')
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .circle
    {
        position: relative;
        height: 80px;
        width: 80px;
        border-radius: 50%;

    }

    .circle .box,
    .circle .box span
    {
        position: absolute;
        top: 50%;
        left: 50%;

    }

    .circle .box
    {
        height: 100%;
        width: 100%;
        background: #fff;
        transform: translate(-50%, -50%) scale(0.8);
        border-radius: 50%;
    }

    .circle .box span
    {
        font-size: 20px;
        font-weight: 600;
        font-family: sans-serif;
        transform: translate(-50%, -50%);
    }

    .text
    {
        font-size: 15px;
        font-weight: 500;
    }
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h5 class="text-center mb-4 fs-2 w-50" style="border-bottom: 1px solid #ddd;">{{ $batch->course->courseDetails->slug }} - {{ $batch->batch_name }} Batch Scholarship</h5>
            <p class="text-center mb-4 fs-6" style="margin-top:-20px;">Attendance - 10 Points, Assignment - 10 Points, Internal Exam - 40 Points, Board Exam - 40 Points</p>
            <div class="col-md-7 px-4 bg-white shadow">
                <h5 class="text-center" style="background: #0727dbfb; padding: 5px; color: #fff; font-weight: 500; margin-bottom: 0;">Scholarship Ranking - {{ $semester->semester_name }} Semester</h5>
                <table style="border-collapse: collapse; width: 100%; margin-top: 20px; margin-bottom: 40px;" >
                    <tr style="">
                        <th style="text-align: center;">
                            <img src="{{ asset('images/medal/gold-medal.png') }}" alt="" style="width: 60px;">
                        </th>
                        <td style="text-align: center;">
                            <h5 style="font-weight: 600">{{ $topper->user->firstname }} {{ $topper->user->lastname }}</h5>
                            <p style="margin-top: -10px; font-size: 14px;">{{ $topper->symbol_number }}</p>
                            <p style="margin-top: -20px; font-size: 30px;">{{ $topper->overall }}</p>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="back">
                                        <div class="circle">
                                            <?php $attendance_value = $topper->attendancePercentage/100; ?>
                                            <div class="bar" data-value="{{ $attendance_value }}" data-fill="{         &quot;color&quot;: &quot;#068f36&quot;     }">
                                                <div class="box">
                                                    <span>{{ $topper->attendancePercentage }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Attendance</div>
                                </div>
                                <div>
                                    <div class="back">
                                        <div class="circle">
                                            <?php $assignment_value = $topper->assignmentPercentage/100; ?>
                                            <div class=" bar" data-value="{{ $assignment_value }}" data-fill="{         &quot;color&quot;: &quot;#0356ad&quot;     }">
                                                <div class="box">
                                                    <span>{{ $topper->assignmentPercentage }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Assignment</div>
                                </div>
                                <div>
                                    <div class="back">
                                        <div class="circle">
                                            <?php $internal_value = $topper->internalExamPercentage/100; ?>
                                            <div class=" bar" data-value="{{ $internal_value }}" data-fill="{         &quot;color&quot;: &quot; #ad6703&quot;     }">
                                                <div class="box">
                                                    <span>{{ $topper->internalExamPercentage }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Internal Exam</div>
                                </div>
                                <div>
                                    <div class="back">
                                        <div class="circle">
                                            <?php $board_value = $topper->boardPercentage/100; ?>
                                            <div class=" bar" data-value="{{ $board_value }}" data-fill="{         &quot;color&quot;: &quot; #F33F45&quot;     }">
                                                <div class="box">
                                                    <span>{{ $topper->boardPercentage }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Board Exam</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="">
                        <th style="text-align: center;">RANK</th>
                        <th>STUDENT</th>
                        <th style="text-align: right; margin-right: 100px;">POINTS</th>
                    </tr>
                    @foreach ($students as $key => $student)
                        <tr>
                            <td style="text-align: center;">
                                @if ($key==0)
                                    <img src="{{ asset('images/medal/silver-medal.png') }}" alt="" style="width: 35px;">
                                @elseif ($key==1)
                                    <img src="{{ asset('images/medal/bronze-medal.png') }}" alt="" style="width: 35px;">
                                @endif
                            </td>
                            <td >{{ $student->user->firstname }} {{ $student->user->lastname }}</td>
                            <td style="text-align: right;">{{ $student->overall }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    let options = {
        startAngle: -1.55,
        size: 80,
    }
    $('.circle .bar').circleProgress(options).on('cicle-animation-progress', function(event, progress, stepValue)
    {
        $(this).parent().find('span').text(String(stepValue.toFixed(2).substr(1)) + "%");
    });
@endsection
