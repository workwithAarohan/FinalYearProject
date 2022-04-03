@extends('layouts.common')

@section('title')
    Scholarship - {{ $semester->semester_name }}
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
            <h5 class="text-center mb-4 fs-2">{{ $batch->course->courseDetails->slug }} - {{ $batch->batch_name }} Batch Scholarship</h5>
            <div class="col-md-7 px-4 bg-white shadow">
                <h5 class="text-center" style="background: #0727dbfb; padding: 5px; color: #fff; font-weight: 500; margin-bottom: 0;">Scholarship Ranking - {{ $semester->semester_name }} Semester</h5>
                <table style="border-collapse: collapse; width: 100%; margin-top: 20px; margin-bottom: 40px;" >
                    <tr style="">
                        <th style="text-align: center;"><i class="fas fa-medal" style="font-size: 30px; color:#d6c312;"></i></th>
                        <td style="text-align: center;">
                            <h5 style="font-weight: 600">Shyam Bahadur</h5>
                            <p style="margin-top: -10px; font-size: 14px;">55872</p>
                            <p style="margin-top: -20px; font-size: 30px;">76.858</p>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="back">
                                        <div class="circle">

                                            <div class="bar" data-value="1" data-fill="{         &quot;color&quot;: &quot;#068f36&quot;     }">
                                                <div class="box">
                                                    <span>100%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Attendance</div>
                                </div>
                                <div>
                                    <div class="back">
                                        <div class="circle">

                                            <div class=" bar" data-value="0.8438" data-fill="{         &quot;color&quot;: &quot;#0356ad&quot;     }">
                                                <div class="box">
                                                    <span>84.38%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Assignment</div>
                                </div>
                                <div>
                                    <div class="back">
                                        <div class="circle">
                                            <div class=" bar" data-value="0.7105" data-fill="{         &quot;color&quot;: &quot; #ad6703&quot;     }">
                                                <div class="box">
                                                    <span>71.05%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text">Internal Exam</div>
                                </div>
                                <div>
                                    <div class="back">
                                        <div class="circle">
                                            <div class=" bar" data-value="0.75" data-fill="{         &quot;color&quot;: &quot; #F33F45&quot;     }">
                                                <div class="box">
                                                    <span>75%</span>
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
                    <tr >
                        <td style="text-align: center;"><i class="fas fa-medal" style="font-size: 30px; color:#c2c1bd;"></i></td>
                        <td >Aarohan Nakarmi</td>
                        <td style="text-align: right;">74.928</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><i class="fas fa-medal" style="font-size: 30px; color:#e47f2c;"></i></td>
                        <td >Suman Chapagain</td>
                        <td style="text-align: right;">70.24</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pradeep Chapagain</td>
                        <td style="text-align: right;">67.545</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Sujan Kunwar</td>
                        <td style="text-align: right;">65.438</td>
                    </tr>

                    {{-- @foreach ($students as $student)
                        @if ($student->rank == 1)
                            <tr style="">
                                <th style="text-align: center;"><i class="fas fa-medal" style="font-size: 30px; color:#d6c312;"></i></th>
                                <td style="text-align: center;">
                                    <h5 style="font-weight: 600">Shyam Bahadur</h5>
                                    <p style="margin-top: -10px; font-size: 14px;">55872</p>
                                    <p style="margin-top: -20px; font-size: 30px;">76.858</p>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <div class="back">
                                                <div class="circle">
                                                    <?php $attendance_value= $student->attendancePercentage/100 ?>
                                                    <div class="bar" data-value="{{ $attendance_value }}" data-fill="{         &quot;color&quot;: &quot;#068f36&quot;     }">
                                                        <div class="box">
                                                            <span>{{ $student->attendancePercentage }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text">Attendance</div>
                                        </div>
                                        <div>
                                            <div class="back">
                                                <div class="circle">
                                                    <?php $assignment_value = $student->assignmentPercentage/100 ?>
                                                    <div class=" bar" data-value="{{ $assignment_value }}" data-fill="{         &quot;color&quot;: &quot;#0356ad&quot;     }">
                                                        <div class="box">
                                                            <span>{{ $student->assignmentPercentage }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text">Assignment</div>
                                        </div>
                                        <div>
                                            <div class="back">
                                                <div class="circle">
                                                    <?php $exam_value= $student->internalExamPercentage/100 ?>
                                                    <div class=" bar" data-value="{{ $exam_value }}" data-fill="{         &quot;color&quot;: &quot; #ad6703&quot;     }">
                                                        <div class="box">
                                                            <span>{{ $student->internalExamPercentage }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text">Internal Exam</div>
                                        </div>
                                        <div>
                                            <div class="back">
                                                <div class="circle">
                                                    <?php $boards_value = $student->boardPercentage/100 ?>
                                                    <div class=" bar" data-value="{{ $boards_value }}" data-fill="{         &quot;color&quot;: &quot; #F33F45&quot;     }">
                                                        <div class="box">
                                                            <span>{{ $student->boardPercentage }}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text">Board Exam</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    <tr style="">
                        <th style="text-align: center;">RANK</th>
                        <th style="text-align: cente;">STUDENT</th>

                        <th style="text-align: right; margin-right: 100px;">POINTS</th>
                    </tr>

                    @foreach ($students as $student)
                        @if ($student->rank !=1)
                            <tr >
                                @if ($student->rank == 2)
                                    <td style="text-align: center;"><i class="fas fa-medal" style="font-size: 30px; color:#c2c1bd;"></i></td>
                                @elseif ($student->rank == 3)
                                    <td style="text-align: center;"><i class="fas fa-medal" style="font-size: 30px; color:#e47f2c;"></i></td>
                                @else
                                    <td></td>
                                @endif
                                <td >{{ $student->user->firstname }} {{ $student->user->lastname }}</td>
                                <td style="text-align: right;">{{ $student->overall }}</td>

                            </tr>

                        @endif
                    @endforeach --}}
                </table>



                {{-- <table style="border-collapse: collapse; width: 100%;">
                    <tr></tr>
                </table>
                <div class="card" style="border: none; background: #0c1d80fb; border-radius: 0px;">
                    <div class="d-flex p-3 align-items-top" style="color: #fff;">
                        <h5 style="font-weight: bold; font-size: 15px;">1</h5>
                        <div>
                            <h4>Aarohan Nakarmi</h4>
                            <p>15821</p>
                            <p>75.3</p>
                        </div>
                    </div>
                </div>
                <table style="width: 100%; padding: 100px;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Student</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2</td>
                            <td>Suman Chapagain</td>
                            <td>74</td>
                        </tr>
                    </tbody>
                </table> --}}
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
