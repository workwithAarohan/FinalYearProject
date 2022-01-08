@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="float-start">
                    Batch
                </h1>
                <a href="" class="btn btn-success float-end" role="button">
                    Create
                </a>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Student Full Name</th>
                        <th scope="col">Student Address</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($students as $student)
                    <a href="{{ route('batch.show',$student->id) }}"></a>
                        <tr>
                            <th scope="row">{{ $student->id }}</th>

                            <th scope="row">
                                <a href="{{ route('student.show',$student->id) }}" type="button"
                                    >
                                    {{ $student->user->firstname }} {{ $student->user->lastname }}
                                </a>
                            </th>
                            <td>
                                {{ $student->user->permanentAddress }}
                            </th>
                            <td>
                                <a href="" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-user-form-{{ $student->id }}').submit()">
                                    Delete
                                </button>
                                <form id="delete-user-{{ $student->id }}" action="" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $students->links() }}
        </div>
    </div>
@endsection
