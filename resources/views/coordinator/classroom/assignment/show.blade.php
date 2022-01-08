@extends('layouts.nav')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-1 bg-white p-4" style="width: 70px;">
                <i class="fas fa-clipboard-list fs-4" style="background: #3a7fdf; color: #fff; border-radius: 50%; padding: 10px;"></i>
            </div>
            <div class="col-md-8 py-4 bg-white">
                <div class="d-flex justify-content-between w-100" style="">
                    <div class="info">
                        <h4 class=" fs-2" style="color: #0d3cac;">
                            {{ $assignment->title }}
                        </h4>
                        <p style="margin-top: -10px;">
                            {{ $assignment->createdBy->firstname }} {{ $assignment->createdBy->lastname }} <span>&#9679;</span>
                            {{ $assignment->created_at->toFormattedDateString() }}
                        </p>
                    </div>
                    <div class="action">
                        <div class="dropdown">
                            <button class="btn btn-default" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li>
                                    <a href="{{ route('assignment.edit',$assignment->id) }}" class="me-3 text-decoration-none dropdown-item" title="Edit">
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST" class="dropdown-item">
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
                </div>
                <div class="d-flex justify-content-between w-100" style="margin-top: -15px; border-bottom: 1px solid #0078D4">
                    <p class="fw-bold" >
                        {{ $assignment->points }} Points
                    </p>
                    <p class="fw-bold">Due {{ $assignment->due_date }} </p>
                </div>

                @if ($assignment->instruction)
                    <div class="instruction mt-3">
                        <p>{{ $assignment->instruction }}</p>
                        <hr>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
