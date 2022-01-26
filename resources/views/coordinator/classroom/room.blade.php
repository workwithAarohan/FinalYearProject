@extends('layouts.nav')

@section('style')
    <style></style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row mb-4 justify-content-around">
            <div class="col-md-7">
                <div class="mb-3">
                    <h4>{{ $classroom->room_name }}</h4>
                    <p>{{ $classroom->batch->batch_name }}</p>
                </div>
                <div class="mb-3 d-flex justify-content-around">
                    <div class="card" style="width:12rem; border: none;">
                        <div class="card-body">
                            <h5 class="fs-6 fw-bold text-center">Course Completed</h5>
                            <div class="progress mt-4" style="height: 15px; position: relative;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $classroom->courseCompleted }}%" aria-valuenow="{{ $classroom->courseCompleted }}" aria-valuemin="0" aria-valuemax="100"></div>
                                <h6 class="fw-bold my-auto" style="position: absolute; left: 40%; top: 1px; font-size: 13px; ">
                                    {{ $classroom->courseCompleted }}%
                                </h6>
                              </div>
                        </div>
                    </div>
                    <div class="card" style="width:12rem;">
                        <div class="card-body">
                          <h5 class="card-title">Attendance</h5>
                          <h6 class="card-subtitle mb-2 text-muted ">80%</h6>
                        </div>
                    </div>
                    <div class="card" style="width:12rem; border: none;">
                        <div class="card-body">
                            <h5 class="fs-6 fw-bold text-center">Assignment</h5>
                            <div class="progress mt-4" style="height: 15px; position: relative;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $classroom->percent }}%" aria-valuenow="{{ $classroom->percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                <h6 class="fw-bold my-auto" style="position: absolute; left: 40%; top: 1px; font-size: 13px; ">
                                    {{ $classroom->percent }}%
                                </h6>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-2 p-4 bg-white rounded shadow" style="width: 250px;">
                    <a href="{{ route('assignment.index', $classroom->id) }}" class="mb-3 text-primary text-decoration-none fs-4 fw-bold ">Assignment</a>
                    @foreach ($assignments as $assignment)
                        <div class=" d-flex justify-content-between align-items-baseline p-2">
                            <a href="{{ route('assignment.show', $assignment->id) }}" class=" text-dark">{{ $assignment->title }}</a>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $assignment->daysLeft }} days left</h6>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
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

                <div class="p-0 border" style="width: 400px;">
                    <div class="d-flex bg-white align-items-baseline" style="height: 50px; padding-left: 20px;">
                        <h5 class="me-2 mt-3" style="font-size: 18px;">Announcements</h5>
                        <p class="" style="font-size: 15px; background: #0029e2; border-radius: 50%; padding: 3px 10px; color: #fff;">{{ $announcements->count() }}</p>
                    </div>

                    <div class="announcement-body p-4" style=" height: 340px; overflow-y:auto;">
                        @foreach ($announcements as $announcement)
                            <div class="d-flex align-items-top">
                                <div class="me-2">
                                    <img src="{{ asset('images/profile/'.$announcement->createdBy->avatar) }}" alt="createdBy" style="width: 40px; border-radius: 50%;">
                                </div>
                                <div class="">
                                    <div class=" d-flex">
                                        <p style="font-size: 11px; background: #777777; border-radius: 12px; padding: 1px 10px; color: #fff; margin-right: 10px;">
                                            <strong>{{ $announcement->createdBy->firstname }} {{ $announcement->createdBy->lastname }}</strong>
                                        </p>
                                        <p style="font-size: 12px;">
                                            {{ $announcement->updated_at->toFormattedDateString() }} {{ date('h:i A', strtotime($announcement->updated_at)) }}
                                        </p>
                                    </div>

                                    <div>
                                        <p style="font-size: 15px; margin-top: -10px; margin-left: 2px;">
                                            {{ $announcement->notice }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 shadow" style="padding: 10px 40px; margin: 10px 100px; border: none;">
            <div class="d-flex justify-content-between">
                <h4 class="fw-bold mt-2 mb-3">Course Structure</h4>
                <button type="button" class="px-2" data-bs-toggle="modal" data-bs-target="#addTopic" style="background: #2664d8; border: none; color: #fff;">
                    Add Topic
                </button>

                <!-- Modal -->
                <div class="modal fade" id="addTopic" tabindex="-1" aria-labelledby="selectCourse" aria-hidden="true">
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
                            <th scope="col" class="text-center">Credit Hrs</th>
                            <th scope="col" class="text-center">Remarks</th>
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
                                    <h6 style="font-size: 16px;">
                                        {{ $topic->topic_title }}
                                    </h6>
                                    <ul>
                                        @foreach ($topic->subTopics as $subTopic)
                                            @if ($subTopic->is_completed)
                                                <li style="font-size: 14px; font-weight: bold; color: #03b62a">{{ $subTopic->title }} <i class="fas fa-check-circle"></i></li>
                                            @else
                                                <li>{{ $subTopic->title }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="align-middle text-center" style="font-size: 15px;">
                                    {{ $topic->credit_hrs }} Hrs.
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <div class="checked me-3 text-center">
                                            <h5 style="font-size: 25px;">
                                                {{ $topic->assignments->count() }}
                                            </h5>
                                            <p class="muted" style="font-size: 13px; margin-top: -10px;">Assignments</p>
                                        </div>
                                        <div class="vr me-3" style="height: 48px; width: 2px;"></div>
                                        <div class="checked me-3 text-center">
                                            <h5 style="font-size: 25px;">
                                                0
                                            </h5>
                                            <p class="muted" style="font-size: 13px; margin-top: -10px;">Notes</p>
                                        </div>
                                    </div>

                                </td>
                                @can('logged-in')
                                    <td class="align-middle">
                                        <div class="d-flex align-items-baseline">
                                            <div class="dropdown">
                                                <button class="" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" style="background: transparent; border: none;">
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
