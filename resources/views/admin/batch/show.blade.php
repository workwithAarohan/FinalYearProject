@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-12">
                <h1 class="float-start">
                    {{ $batch->batch_name }} Batch
                </h1>
                <a href="{{ route('admission.closed', $batch->id) }}" class="btn btn-warning float-end" role="button">
                    End Session
                </a>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px;" >
            <table class="table table-hover" style="font-size: small;">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Course</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <th scope="row">{{ $student->user->firstname }}</th>
                            <th scope="row">{{ $student->user->lastname }}</th>
                            <td>{{ $student->user->username }}</td>
                            <td>{{ $student->course->name }}</td>
                            <td>
                                <a href="" class="me-3 text-decoration-none text-secondary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                        document.getElementById('delete-user-form-{{ $student->id }}').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <form id="delete-user-{{ $student->user->id }}" action="" method="POST" style="display:none;">
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
@endsection
