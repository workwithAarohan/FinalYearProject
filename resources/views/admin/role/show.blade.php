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
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="float-start">
                    {{ $batch->batch_name }} Batch
                </h1>
                @if ($batch->admissionWindow->is_open)
                    <a href="{{ route('admission.closed', $batch->id) }}" class="btn btn-warning float-end ms-3" role="button">
                        End Session
                    </a>
                @endif
                <a href="{{ route('classroom.index', $batch->id) }}" class="btn btn-success float-end">
                    Classroom
                </a>

            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px;" >
            <table class="table table-hover" style="font-size: small;">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($batch->admissionWindow->admissions as $student)
                        <tr data-href="{{ route('admission.details', $student->id) }}">
                            <th scope="row">{{ $student->firstname }}</th>
                            <th scope="row">{{ $student->lastname }}</th>
                            <td>{{ $batch->course->courseDetails->slug }}</td>
                            @if ($student->is_admitted)
                                <td>
                                    <a href="" class="badge bg-success text-decoration-none">Admitted</a>
                                </td>
                            @else
                                <td>
                                    <span class="badge bg-warning text-dark">Not Admitted</span>
                                </td>
                            @endif
                            <td>
                                <a href="" class="me-3 text-decoration-none text-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                        document.getElementById('delete-user-form-{{ $student->id }}').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <form id="delete-user-{{ $student->id }}" action="" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                {{-- <tbody>
                    @foreach ($students as $key => $value)
                        @foreach ($value->users as $user)
                            <tr>
                                <th scope="row">{{ $user->firstname }}</th>
                                <th scope="row">{{ $user->lastname }}</th>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    <a href="" class="me-3 text-decoration-none text-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $value->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-user-{{ $user->id }}" action="" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody> --}}
            </table>
            {{ $students->links() }}
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
