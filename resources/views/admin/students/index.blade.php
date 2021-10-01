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
                    @foreach ($students as $key => $value)
                    <a href="{{ route('batch.show',$value->id) }}"></a>
                        <tr>
                            <th scope="row">{{ $value->id }}</th>
                            
                            <th scope="row">
                                <a href="{{ route('student.show',$value->id) }}" type="button"
                                    >
                                    {{ $value->firstname }} {{ $value->lastname }}
                                </a>
                            </th> 
                            <td>
                                {{ $value->permanentAddress }}
                            </th> 
                            <td>
                                <a href="" class="btn btn-sm btn-primary">
                                    Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" 
                                        onclick="event.preventDefault();
                                        document.getElementById('delete-user-form-{{ $value->id }}').submit()">
                                    Delete
                                </button>
                                <form id="delete-user-{{ $value->id }}" action="" method="POST" style="display:none;">
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