@extends('layouts.nav')

@section('style')
    <style>
        h5.background
        {
            font: 14px sans-serif;
            margin-top: 30px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            z-index: 1;
            font-weight: bold;
        }

        h5.background:before
        {
            border-top: 1px solid #ccc6c6;
            content:"";
            margin: 0 auto;
            position: absolute;
            top: 8px; left: 0; right: 0; bottom: 0;
            width: 95%;
            z-index: -1;
        }

        h5.background span
        {
            background: #F8FAFC;
            padding: 0 15px;
        }


    </style>
@endsection

@section('content')
    <div class="container mt-3">
        <h5>{{ $classroom->room_name }}</h5>
        <div class="row" style="column-gap: 20px;">
            <div class="col-md-5" style="background: #fff; padding: 30px 30px; width: 420px; height: 400px;">
                <div class="d-flex mb-3 justify-content-between align-items-center">
                    <img src="{{ asset('images/profile/'.$student->user->avatar) }}" alt="" style="width: 150px; height: 150px;" class="me-2 shadow">
                    <div style="border: 2px solid; width: 120px;">
                        <h5 style="font-size: 20px; font-weight: bold; margin:5px; text-align: center;">
                            Overall
                        </h5>
                        <hr style="margin: 0; height: 2px;  opacity: 1;">
                        <p style="font-size: 18px; font-weight: bold; margin: 5px; text-align: center;">
                            {{ $student->attendancePercent }}
                        </p>
                    </div>
                </div>
                <div class="student-details">
                    <h5 style="font-size: 18px; font-weight: bold;">{{ $student->user->firstname }} {{ $student->user->lastname }}</h5>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <th>Symbol Number</th>
                                <td>{{ $student->symbol_number }}</td>
                            </tr>
                            <tr>
                                <th>TU Registration</th>
                                <td>{{ $student->registration_number }}</td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td>{{ $student->course->courseDetails->slug }}</td>
                            </tr>
                            <tr>
                                <th>Batch</th>
                                <td>{{ $student->batch->batch_name }}</td>
                            </tr>
                            <tr>
                                <th>Semester</th>
                                <td>{{ $student->semester->semester_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col bg-white p-4">
                <label for="">Attendance Report</label>
                <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" style="width: {{$student->attendancePercent}}%;" aria-valuenow="{{$student->attendancePercent}}" aria-valuemin="0" aria-valuemax="100">{{$student->attendancePercent}}%</div>
                </div>
                <label for="">Assignment Report</label>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{$student->assignmentPercent}}%;" aria-valuenow="{{$student->assignmentPercent}}" aria-valuemin="0" aria-valuemax="100">{{$student->assignmentPercent}}%</div>
                </div>

                <h5 class="background">
                    <span>Assignment Details</span>
                </h5>
                <table style="width: 100%; margin-top: 10px; border-collapse: separate; border-spacing: 0 10px;">
                    <thead>
                        <tr class="mt-3" style="padding: 8px;">
                            <th style=" padding: 12px;">Assignment Title</th>
                            <th style="padding: 12px;">Topic</th>
                            <th class="text-center" style=" padding: 12px;">Points Obtained</th>
                            <th class="text-center" style="padding: 12px;">Total Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classroom->assignments as $assignment)

                            <tr style="background: #eeeded; border-radius: 5px;">
                                <td style="font-size: 13px; padding: 12px;">{{ $assignment->title }}</td>
                                <td style="font-size: 13px; padding: 12px;">{{ $assignment->topic->topic_title }}</td>
                                @foreach ($assignment->student_points as $student_point)
                                    @if ($student_point->student->id == $student->id)
                                        <td style="font-size: 13px; padding: 10px;" class="text-center">{{ $student_point->pointsObtained }}</td>
                                    @endif
                                @endforeach
                                <td style="font-size: 13px; padding: 10px;" class="text-center">{{ $assignment->points }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script>
        function progressBar(progressVal,totalPercentageVal = 100) {
            var strokeVal = (4.64 * 100) /  totalPercentageVal;
            var x = document.querySelector('.progress-circle-prog');
            x.style.strokeDasharray = progressVal * (strokeVal) + ' 999';
            var el = document.querySelector('.progress-text');
            var from = $('.progress-text').data('progress');
            $('.progress-text').data('progress', progressVal);
            var start = new Date().getTime();

            setTimeout(function() {
                var now = (new Date().getTime()) - start;
                var progress = now / 700;
                el.innerHTML = progressVal / totalPercentageVal * 100 + '%';
                if (progress < 1) setTimeout(arguments.callee, 10);
            }, 10);

        }

        progressBar(10,100);
    </script>
@endsection
