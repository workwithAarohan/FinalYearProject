@extends('layouts.nav')

@section('style')
    <style>
        tr[data-href]
        {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="float-start">
                    Classroom
                </h1>
                {{-- <a href="{{ route('course.classroom.create', $course->id) }}" class="btn btn-success float-end" role="button">
                    Create
                </a> --}}
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Classroom Name</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Status</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    @foreach ($classrooms as $classroom)
                        <tr data-href="{{ route('classroom.show',$classroom->id) }}">
                            <th scope="row">{{ $classroom->id }}</th>

                            <td>
                                {{ $classroom->room_name }}
                            </td>
                            <td>
                                {{ $classroom->batch->batch_name }}
                            </td>
                            <td>
                                {{ $classroom->subject->subject_name }}
                            </td>
                            <td>
                                @if($classroom->is_active)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            @can('logged-in')
                                <td>
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
                                    {{-- <a href="{{ route('classroom.edit',$classroom->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $classroom->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-user-form-{{ $classroom->id }}" action="{{ route('classroom.destroy',$classroom->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $classrooms->links() }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded',() => {
            const rows = document.querySelectorAll("tr[data-href]");

            rows.forEach(row => {
                row.addEventListener("click", () => {
                    window.location.href = row.dataset.href;
                });
            });
        });
        // $(document).ready(function(){
        //     $(document.body).on("click", "tr[data-href]", function(){
        //         window.location.href = this.dataset.href;
        //     });
        // });
    </script>
@endsection
