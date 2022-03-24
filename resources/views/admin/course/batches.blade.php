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
                   {{ $course->courseDetails->slug }} - Batch
                </h1>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Batch</th>
                        <th scope="col">No.of Students</th>
                        <th scope="col">Created By</th>
                        @role('Admin')
                            <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>

                <tbody>
                    @foreach ($batches as $batch)
                        <tr data-href="{{ route('batch.show',$batch->id) }}">
                            <th scope="row">{{ $batch->id }}</th>

                            <th scope="row">
                                {{ $batch->batch_name }}
                            </th>
                            <td>
                                {{ $batch->students->count() }}
                            </td>
                            <td>
                                {{ $batch->createdBy->firstname }}
                            </td>
                            @role('Admin')
                                <td>

                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('batch.edit',$batch->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('batch.destroy', $batch->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger btn" title="Delete" style="padding: 0px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endrole
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
