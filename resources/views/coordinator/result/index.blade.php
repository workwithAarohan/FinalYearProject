@extends('layouts.common')

@section('title')
    Result - {{ $examination->exam_title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="d-flex align-items-top">
                    <h4 class="me-2" style="font-size: 24px; font-weight: bold;">{{ $examination->exam_title }}</h4>
                    <div>
                        @if ($examination->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-danger">Not Published</span>
                        @endif
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
                    <p><b>Note: </b> Update Examination Details to Assign Marks to Student</p>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ route('update.table') }}" method="POST" class=" bg-white shadow border">
                    @csrf

                    <h5 class="text-center py-2 bg-light">Examination Details</h5>

                    <div class="mb-3 px-4">
                        <label for="subject" class="form-label">
                            Subject
                        </label>
                        <input type="text" class="form-control" disabled value="{{ $subject->subject_code }} - {{ $subject->subject_name }}">
                    </div>
                    <div class="mb-3 px-4">
                        <div class="d-flex">
                            <div class="me-3">
                                <label for="full_mark" class="form-label">Full Mark</label>
                                <input type="text" class="form-control" name="full_mark" value="{{ $value->full_mark }}">
                            </div>
                            <div>
                                <label for="pass_mark" class="form-label">Pass Mark</label>
                                <input type="text" class="form-control" name="pass_mark" value="{{ $value->pass_mark }}">
                            </div>

                            <input type="hidden" name="exam" value="{{ $examination->id }}">
                            <input type="hidden" name="subject" value="{{ $subject->id }}">
                        </div>
                    </div>

                    <div class="mb-3 px-4">
                        <button type="submit" style="border: none; background: #ddd; border-radius: 5px; padding: 8px 16px;">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row ms-2 border mt-3 px-5 bg-white" style="width: 450px;">
            <h5 class="py-3 fw-bold">Marks Evaluation</h5>

            <table style="width: 300px;">
                <tr>
                    <th>Student Name</th>
                    <th>Marks Obtained</th>
                </tr>
                <form action="{{ route('result.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="examination_id" value="{{ $examination->id }}">
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    @foreach ($results as $result)
                    <input type="hidden" name="students[{{ $result->student->id }}]" value="{{ $result->student->id }}">
                        <tr>
                            <td>
                                {{ $result->student->user->firstname }} {{ $result->student->user->lastname }}
                            </td>
                            <td class="d-flex align-items-baseline">
                                @if (!$examination->is_locked)
                                    <input type="text" class="form-control" name="marks_obtained[{{ $result->student->id}}]" value="{{ $result->marks_obtained }}" style="width: 60px;">
                                @else
                                    <input type="text" class="form-control" name="marks_obtained[{{ $result }}]" value="{{ $result->marks_obtained }}" style="width: 60px;" disabled>
                                @endif
                                <p class="ms-2 fs-5">/ {{ $value->full_mark }}</p>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td>
                            <div class="mb-3 px-4">
                                @if (!$examination->is_locked)
                                    <button type="submit" style="border: none; background: #ddd; border-radius: 5px; padding: 8px 16px;">Submit</button>
                                @else
                                    <button type="submit" style="border: none; background: #ddd; border-radius: 5px; padding: 8px 16px;" disabled>Submit</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
@endsection
