@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row mb-4 justify-content-around">
            <div class="col-md-7">
                <div class="mb-3">
                    <h4>{{ $classroom->room_name }}</h4>
                    <p>{{ $classroom->batch->batch_name }}</p>
                </div>
                <div class="mb-3 d-flex justify-content-around">
                    <div class="card" style="width:12rem;">
                      <div class="card-body">
                        <h5 class="card-title">Course Completed</h5>
                        <h6 class="card-subtitle mb-2 text-muted ">80%</h6>
                      </div>
                    </div>
                    <div class="card" style="width:12rem;">
                        <div class="card-body">
                          <h5 class="card-title">Attendance</h5>
                          <h6 class="card-subtitle mb-2 text-muted ">80%</h6>
                        </div>
                    </div>
                    <div class="card" style="width:12rem;">
                        <div class="card-body">
                          <h5 class="card-title">Assignment</h5>
                          <h6 class="card-subtitle mb-2 text-muted ">80%</h6>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-2 p-4 bg-white w-50 rounded shadow ">
                    <h5 class="fw-bold mb-3">Assignments</h5>
                    @foreach ($classroom->assignments as $assignment)
                        <div class="card" style="border:none;">
                            <div class="card-body d-flex justify-content-between align-items-baseline">
                                <a href="{{ route('assignment.show', $assignment->id) }}" class="card-title text-dark">{{ $assignment->title }}</a>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $assignment->due_date }}</h6>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4 ">
                <div class="row p-4">
                    <form action="{{ route('announcement.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                        <div class=" d-flex">
                            <input type="text" placeholder="Add Announcement" name="notice" class="form-control me-3">
                            <button class="btn btn-primary form-control" type="submit">
                                Add
                            </button>
                        </div>
                    </form>
                </div>

                <div class="row bg-white p-4 rounded shadow">
                    <h5 class="fw-bold mb-3">Announcements</h5>
                    <table class="table table-hover">
                        @foreach ($classroom->announcements as $announcement)
                            <tbody>
                                <tr>
                                    <td>{{ $announcement->createdBy->firstname }}</td>
                                    <td>{{ $announcement->notice }}</td>
                                    <td>{{ $announcement->created_at }}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow" style="padding: 10px 40px; ">
            <h5 class="fw-bold mt-2 mb-3">Course Structure</h5>
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Credit Hrs</th>
                        <th scope="col">Remarks</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    <?PHP $i=1; ?>
                    @foreach ($classroom->topics as $topic)
                        <tr data-href="{{ route('classroom.show',$topic->id) }}">
                            <th scope="row">{{ $i }}</th>

                            <td>
                                {{ $topic->title }}
                                <ul>
                                    @foreach ($topic->subTopics as $subTopic)
                                        <li>{{ $subTopic->title }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="align-middle">
                                {{ $topic->credit_hrs }}
                            </td>
                            <td class="align-middle">
                                Assignments: {{ $topic->assignments->count() }}
                                <br> Notes: 0
                            </td>
                            @can('logged-in')
                                <td class="align-middle">
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('classroom.edit',$classroom->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('classroom.destroy', $classroom->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger p-0 btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endcan
                        </tr>

                        <?PHP  $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
