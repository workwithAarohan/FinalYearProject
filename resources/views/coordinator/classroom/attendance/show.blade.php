@extends('layouts.nav')

@section('style')
    <style>
        .mytooltip
        {
            width: 600px !important;
        }
        .help
        {
            width: 1000px;
        }

        .image
        {
            width: 50px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="">
        <div class="row" style="column-gap: 20px; margin: 5px 40px;">

            <div class="col-md-7 mt-2 p-2">
                <h5 class="fw-bold" style="font-size: 20px;">Attendance Details</h5>

                <table class="table table-hover">
                    <thead>
                        <tr >
                            <th scope="col">Student</th>
                            <th scope="col" class="text-center">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance->students as $student)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex p-2">
                                        <div class="student-avatar me-2">
                                            <img src="{{ asset('images/profile/'.$student->user->avatar) }}" alt="" style="width: 40px; border-radius: 50%;" class="">
                                        </div>
                                        <div class="student-profile">
                                            <a href="{{ route('classroom.student.performance', [$attendance->classroom->id, $student->id]) }}" class="fw-bold text-decoration-none student-details" id="{{ $student->id }}" style="font-size: 14px;">{{ $student->user->firstname }} {{ $student->user->lastname }}</a>
                                            <p style="margin-top: -5px; font-size: 13px; color: #888888;">{{ $student->symbol_number }}</p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle text-center" style="font-size: 12px;">
                                    @if ($student->status == 'Present')
                                        <span style="background: #038a15; padding: 1px 8px; border-radius: 10px; color: #fff;">{{ $student->status }}</span>
                                    @elseif($student->status == 'Absent')
                                        <span style="background: #b90505; padding: 1px 8px; border-radius: 10px; color: #fff;">{{ $student->status }}</span>
                                    @elseif($student->status == 'Leave')
                                        <span style="background: #958c09; padding: 1px 8px; border-radius: 10px; color: #ffffff;">{{ $student->status }}</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('attendance.edit',$attendance->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger p-0 btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col mt-2 p-2" style="">
                <div  style="background: white; padding: 15px; margin-bottom: 15px;">
                    <h5 class="fw-bold" style="font-size: 20px;">About</h5>
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Topic Covered</th>
                                <td>{{ $attendance->topic_covered }}</td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td>{{ $attendance->classroom->batch->course->courseDetails->slug }}</td>
                            </tr>
                            <tr>
                                <th>Batch</th>
                                <td>{{ $attendance->classroom->batch->batch_name }}</td>
                            </tr>
                            <tr>
                                <th>Classroom</th>
                                <td>{{ $attendance->classroom->room_name }}</td>
                            </tr>
                            <tr>
                                <th>Attendance Date</th>
                                <td>{{ $attendance->attendance_date }}</td>
                            </tr>
                            <tr>
                                <th>No. of Student</th>
                                <td>{{ $attendance->students->count() }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div id="piechart" style="height: 300px;"></div>
            </div>

        </div>
    </div>


    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Attendance', 'Status'],
            <?php
                echo($statusCount);
            ?>
            ]);

            var options = {
            title: 'Student Attendance',
            pieHole: 0.4,
            colors: ['#541F8F', '#8425EF', '#B279F1'],

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        $(document).ready(function(){
            $('.student-details').tooltip({
                title: fetchData,
                html: true,
                tooltipClass: "mytooltip",
            });
            // $('.student-details').tooltip({
            //     classes: {
            //         'ui-tooltip':'highlight'
            //     },
            //     position:{my:'left center', at: 'right+50 center'},
            //     content:function(result){
            //         $.post("{{ route('attendance.retrieveData', $attendance->classroom->id) }}" ,{
            //             id:$(this).attr('id'),
            //             "_token":"{{ csrf_token() }}"
            //         }, function(data){
            //             result(data);
            //         });
            //     }
            // });

            function fetchData()
            {
                var fetch_data = '';
                var element = $(this);
                var id = element.attr('id');

                $.ajax({
                    url: "{{ route('attendance.retrieveData', $attendance->classroom->id) }}",
                    method: "POST",
                    beforesend: function (xhr) {
                        xhr.setRequestHeader("X-XSRF-TOKEN", $('input:hidden[name =" __RequestVerificationToken"]').val());
                    },
                    async: false,
                    data: {id:id, "_token":"{{ csrf_token() }}"},
                    success:function(data)
                    {
                        fetch_data = data;
                    }
                });
                return fetch_data;
            }
        });
    </script>
@endsection
