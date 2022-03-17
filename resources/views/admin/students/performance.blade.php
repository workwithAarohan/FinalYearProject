@extends('layouts.common')

@section('title')
    Student Performance
@endsection

@section('style')
    .background
    {
        font-size: 14px;
        margin-top: 30px;
        position: relative;
        text-align: center;
        text-transform: uppercase;
        z-index: 1;
        font-weight: bold;
    }

    .background:before
    {
        border-top: 1px solid #ccc6c6;
        content:"";
        margin: 0 auto;
        position: absolute;
        top: 8px; left: 0; right: 0; bottom: 0;
        width: 95%;
        z-index: -1;
    }

    .background span
    {
        background: #fff;
        padding: 0 15px;
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
        <div class="row justify-content-around" style="column-gap: 40px;">
            <div class="col-md-6 mb-4">
                <div class="row">
                    <div class="col-md-4 shadow" style="background: #fff; padding: 30px 30px; width: 380px; height: 340px;">
                        <div class="d-flex mb-3 justify-content-between align-items-center">
                            <img src="{{ asset('images/profile/'.$student->user->avatar) }}" alt="" style="width: 100px; height: 100px;" class="me-2 shadow">
                            <div style="border: 2px solid; width: 120px;">
                                <h5 style="font-size: 20px; font-weight: bold; margin:5px; text-align: center;">
                                    Overall
                                </h5>
                                <hr style="margin: 0; height: 2px;  opacity: 1;">
                                <p style="font-size: 18px; font-weight: bold; margin: 5px; text-align: center;">
                                    @if ($overall>=80)
                                        Excellent
                                    @elseif ($overall<80 and $overall>=65)
                                        Good
                                    @elseif ($overall<65 and $overall>=50)
                                        Average
                                    @else
                                        Bad
                                    @endif
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
                </div>
                <div class="row mt-4 p-2 shadow bg-white">
                    <div id="barchart_material" style="width: 900px; height: 500px"></div>
                </div>
            </div>
            <div class="col-md-5 bg-white p-4 shadow">
                @foreach ($semesters as $semester)
                    <h5 class="background">
                        <span>{{ $semester->semester_name }} Semester</span>
                    </h5>

                    <div class="d-flex justify-content-around">
                        <div>
                            <div class="back">
                                <div class="circle">
                                    <?php $attendance_value= $semester->attendance/100 ?>
                                    <div class="bar" data-value="{{ $attendance_value }}" data-fill="{         &quot;color&quot;: &quot;#068f36&quot;     }">
                                        <div class="box">
                                            <span>{{ $semester->attendance }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text">Attendance</div>
                        </div>
                        <div>
                            <div class="back">
                                <div class="circle">
                                    <?php $assignment_value= $semester->assignment/100 ?>
                                    <div class=" bar" data-value="{{ $assignment_value }}" data-fill="{         &quot;color&quot;: &quot;#0356ad&quot;     }">
                                        <div class="box">
                                            <span>{{ $semester->assignment }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text">Assignment</div>
                        </div>
                        <div>
                            <div class="back">
                                <div class="circle">
                                    <?php $exam_value= $semester->exam/100 ?>
                                    <div class=" bar" data-value="{{ $exam_value }}" data-fill="{         &quot;color&quot;: &quot; #ad6703&quot;     }">
                                        <div class="box">
                                            <span>{{ $semester->exam }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text">Examination</div>
                        </div>
                    </div>



                @endforeach
            </div>
            {{-- <div class="col-md-2">
                <div class="back">
                    <div class="circle js ">
                        <div class="bar">
                            <div class="box">
                                <span>80%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text">Attendance</div>
                <div class="back">
                    <div class="circle react">
                        <div class=" bar">
                            <div class="box">
                                <span>90%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text">Attendance</div>
            </div> --}}
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

    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
        ['Semester', 'Attendance', 'Assignment', 'Examination'],
        <?php echo($data) ?>
        ]);

        var options = {
        chart: {
            title: 'Student Performance',
            subtitle: 'Attendance, Assignment, Examination',
        },
        bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

    {{-- google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Semester', 'Attendance', 'Assignment', 'Examination'],
          <?php echo($data) ?>
        ]);

        var options = {

          title: 'Student Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var options = {
            chart: {
              title: 'Student Performance',
              subtitle: 'Attendance', 'Assignment', 'Examination',
            },
            bars: 'horizontal' // Required for Material Bar Charts.
          };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      } --}}

@endsection

