@extends('layouts.common')

@section('title')
    {{ $examination->exam_title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="d-flex align-items-top">
                    <h4 class="me-2" style="font-size: 24px; font-weight: bold;">{{ $examination->exam_title }}</h4>
                    <div>
                        <form action="{{ route('examination.publish') }}" method="POST">
                            @csrf
                            <input type="hidden" name="examination_id" value="{{ $examination->id}}">

                            <button type="submit" class="show_confirm" data-toggle="tooltip" style="background: transparent; border: none;" >
                                @if ($examination->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-danger">Not Published</span>
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
                <div class="d-flex" style="margin-top: -10px;">
                    <p class="me-3">{{ $examination->course->courseDetails->slug }}</p>
                    <p class="me-3">Batch - {{ $examination->batch->batch_name }}</p>
                    <p>{{ $examination->semester->semester_name }} Semester</p>
                </div>
                <div class="row">
                    <h5>Instructions</h5>
                    <p>{{ $examination->instruction }}</p>
                </div>

                <div class="row">
                    <h5>Time</h5>
                    <p>{{ date('h:i A', strtotime($examination->start_time)) }} - {{ date('h:i A', strtotime($examination->end_time)) }}</p>
                </div>
                <div class="row">
                    <div class="d-flex">
                        @foreach ($examination->subjects as $subject)
                            <div class="card p-3 me-2" style="width: 190px;">
                                @role('Teacher')
                                    <a href="{{ route('result.index', [$examination->id, $subject->id]) }}" style="font-size: 14px;" class="fw-bold text-decoration-none">{{ $subject->subject_name }}</a>
                                @else
                                    <a href="" style="font-size: 14px;" class="fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#add{{ $subject->id }}">{{ $subject->subject_name }}</a>
                                @endrole
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="add{{ $subject->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">{{ $subject->subject_name }}</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($subject->pivot->is_checked)
                                            <table class="table table-hover" style="font-size:small;">
                                                <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th>Marks Obtained</th>
                                                        <th>Full Marks</th>
                                                        <th>Pass Marks</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($examination->batch->students as $student)
                                                        <tr>
                                                            <th scope="row">{{ $student->user->firstname }}</th>
                                                            <td>{{ $result[$student->id][$subject->id]->marks_obtained }}</td>
                                                            <td>{{ $subject->pivot->full_mark }}</td>
                                                            <td>{{ $subject->pivot->pass_mark }}</td>

                                                        </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <h5>Not Checked</h5>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col">
                <div id="piechart" style="height: 300px;"></div>
            </div>
        </div>

        <div class="row m-4">
            <h4>Result</h4>
            {{-- @if ($examination->is_published) --}}
                <div class="card shadow " style="padding: 10px 40px; ">
                    <table class="table table-hover" style="font-size:small;">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                @foreach ($examination->subjects as $subject)
                                    <th scope="col">{{ $subject->subject_code }}</th>
                                @endforeach
                                <th>Total</th>
                                <th>Percentage</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($examination->batch->students as $student)
                                <tr>
                                    <th scope="row">{{ $student->user->firstname }}</th>
                                    @foreach ($examination->subjects as $subject)
                                    @if ($result[$student->id][$subject->id]->marks_obtained < $subject->pivot->pass_mark)
                                        <td style="color: red; font-weight: bold;">
                                    @else
                                        <td>
                                    @endif
                                    {{ $result[$student->id][$subject->id]->marks_obtained }}</td>

                                    @endforeach
                                    <td>
                                        {{ $result[$student->id]['total'] }}
                                    </td>
                                    <td>
                                        {{ $result[$student->id]['percentage'] }}
                                    </td>

                                    <td>
                                        @if ($result[$student->id]['status'])
                                            Pass
                                        @else
                                            Fail
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- @else
                <div class="d-flex justify-content-around py-5">
                    <h4 class="fw-bold">No record found</h4>
                </div>
            @endif --}}
        </div>



    </div>
@endsection

@section('script')
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
        ['Status', 'No. of Students'],
        <?php echo($resultReport) ?>
        ]);

        var options = {
        title: 'Result Report',
        pieHole: 0.4,
        colors: ['#037508', '#750303'],

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to change?`,
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
        });
    });
@endsection
