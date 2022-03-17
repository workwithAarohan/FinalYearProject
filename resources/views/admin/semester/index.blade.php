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
                    Semester
                </h1>
                @role('Admin')
                    <a href="{{ route('semester.create') }}" class="btn btn-success float-end" role="button">
                        Create
                    </a>
                @endrole
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Status</th>
                        @role('Admin')
                            <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>

                <tbody>
                    @foreach ($semesters as $key => $semester)
                        <tr data-href="{{ route('semester.show',$semester->id) }}">
                            <th scope="row">{{ $semester->id }}</th>

                            <th scope="row">
                                {{ $semester->semester_name }}
                            </th>
                            <td>
                                {{ $semester->createdBy->firstname }} {{ $semester->createdBy->lastname }}
                            </td>
                            <td>
                                @if ($semester->is_active)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            @role('Admin')
                                <td>
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('semester.edit',$semester->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('semester.destroy', $semester->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger p-0 btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- <a href="{{ route('semester.edit',$semester->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $semester->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-user-form-{{ $semester->id }}" action="{{ route('semester.destroy',$semester->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                            @endrole
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $semesters->links() }}
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
