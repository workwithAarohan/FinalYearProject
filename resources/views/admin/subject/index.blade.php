@extends('layouts.common')

@section('style')
        tr[data-href]
        {
            cursor: pointer;
        }
@endsection


@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="float-start">
                    Subject
                </h1>
                {{-- <a href="{{ route('course.subject.create', $course->id) }}" class="btn btn-success float-end" role="button">
                    Create
                </a> --}}
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Subject Code</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Subject Type</th>
                        @role('Admin')
                            <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>

                <tbody>
                    @foreach ($subjects as $subject)
                        <tr data-href="{{ route('subject.show',$subject->id) }}">
                            <th scope="row">{{ $subject->id }}</th>

                            <th scope="row">
                                {{ $subject->subject_code }}
                            </th>
                            <td>
                                {{ $subject->subject_name }}
                            </td>
                            <td>
                                {{ $subject->course->courseDetails->slug }}
                            </td>
                            <td>
                                {{ $subject->semester->semester_name }}
                            </td>
                            <td>
                                @if ($subject->is_elective)
                                    Elective
                                @else
                                    Non-Elective
                                @endif
                            </td>
                            @role('Admin')
                                <td>
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('subject.edit',$subject->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('subject.destroy', $subject->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger p-0 btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- <a href="{{ route('subject.edit',$subject->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $subject->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-user-form-{{ $subject->id }}" action="{{ route('subject.destroy',$subject->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                            @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $subjects->links() }}
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
