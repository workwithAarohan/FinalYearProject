@extends('layouts.nav')

<style>
    tr[data-href]
    {
        cursor: pointer;
    }
</style>

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="float-start">
                    Batch
                </h1>
                <a href="{{ route('batch.create') }}" class="btn btn-success float-end" role="button">
                    Create
                </a>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Course</th>
                        <th scope="col">No.of Students</th>
                        <th scope="col">Status</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    @foreach ($batches as $key => $value)
                        <tr data-href="{{ route('batch.show',$value->id) }}">
                            <th scope="row">{{ $value->id }}</th>

                            <th scope="row">
                                {{ $value->batch_name }}
                            </th>
                            <td>
                                {{ $value->course->courseDetails->slug }}
                            </td>
                            <td>
                                {{ $value->users()->count() }}
                            </td>
                            <td>
                                @if ($value->is_active)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </td>
                            @can('logged-in')
                                <td>
                                    <a href="{{ route('batch.edit',$value->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                            document.getElementById('delete-user-form-{{ $value->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-user-form-{{ $value->id }}" action="{{ route('batch.destroy',$value->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $batches->links() }}
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
