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
                    <a href="{{ route('assignment.index', $classroom->id) }}" class="btn btn-primary text-white">Assignment</a>
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
            <div class="d-flex justify-content-between">
                <h5 class="fw-bold mt-2 mb-3">Course Structure</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Topic
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="selectCourse">Add Topic</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('topic.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Topic Title</label>
                                        <input type="text" name="topic_title" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Classroom</label>
                                        <input type="text" value="{{ $classroom->room_name }}" class="form-control" disabled>
                                        <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="credit_hr" class="form-label">Credit Hours</label>
                                        <input type="text" name="credit_hrs" class="form-control">
                                    </div>

                                    <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

                                    <div class="mb-3">
                                        <label for="sub_topic" class="form-label">Sub Topics</label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control me-2" name="title[]">
                                            <input type="text" class="form-control me-2" name="title[]">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Select</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover" style="font-size:small;">
                @if ($classroom->topics->count()!=0)
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
                                    {{ $topic->topic_title }}
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
                                            <div class="dropdown">
                                                <button class="btn btn-default" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                    <li>
                                                        <button class="dropdown-item" type="button">Add Sub Topic</button>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('topic.edit',$topic->id) }}" class="me-3 text-decoration-none dropdown-item" title="Edit">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('topic.destroy', $topic->id) }}" method="POST" class="dropdown-item">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="p-0 btn" title="Delete">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>

                                                </ul>
                                            </div>


                                        </div>
                                    </td>
                                @endcan
                            </tr>

                            <?PHP  $i++; ?>
                        @endforeach
                    </tbody>
                @else
                    <div class=" d-flex justify-content-around">
                        <div class="no-content">
                            <h5 class="fs-4">
                                No Topic Found
                            </h5>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Topic
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="selectCourse">Add Topic</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('topic.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Topic Title</label>
                                                    <input type="text" name="title" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">Classroom</label>
                                                    <input type="text" value="{{ $classroom->room_name }}" class="form-control" disabled>
                                                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="credit_hr" class="form-label">Credit Hours</label>
                                                    <input type="text" name="credit_hrs" class="form-control">
                                                </div>

                                                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Select</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#add_btn').on('click', function(){
                var html = "";
                html += '<input type="text" class="form-control" name="title[]">';
            });

            $('.modal-body').append(html);
        });
    </script>
@endsection
