@extends('layouts.nav')

@section('style')
    <style>
        tr[data-href]
        {
            cursor: pointer;
        }

        .role-input:focus
        {
            outline: none;
        }

        .role-input:focus + .role-button
        {
            border: 2px solid #092bc5;
        }


    </style>
@endsection

@section('content')
    <div class="container">
        {{-- @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif --}}
        <div class="row mb-3">
            <div class="col-12">
                <h1 class="float-start">
                    Roles
                </h1>

                <form action="{{ route('role.store') }}" method="post" class="float-end d-flex">
                    @csrf
                    <div class="input-group mb-3" style="">
                        <input type="text" class="role-input" placeholder="Add Role"  name="name" style="background: #fff; width: 300px; border: 1px solid #bebdbd; padding: 8px; border-radius: 5px 0 0 5px;">
                        <button style="background: #092bc5; color: #fff; border: none; border-radius: 0 5px 5px 0; width: 80px;" type="submit" class="px-3 role-button">Add</button>
                      </div>
                </form>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Role</th>
                        <th scope="col">No.of Users</th>
                        <th scope="col">Permissions</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr data-href="{{ route('role.show',$role->id) }}">
                            <th scope="row">
                                {{ $role->id }}
                            </th>
                            <th scope="row">
                                {{ $role->name }}
                            </th>
                            <td>
                                {{ $role->users->count() }}
                            </td>
                            <td>
                                {{ $role->permissions->count() }}
                            </td>
                            @can('logged-in')
                                <td>
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('batch.edit',$role->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('batch.destroy', $role->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger btn" title="Delete" style="padding: 0px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- <a class="text-danger pe-auto" title="Delete" onclick="event.preventDefault();
                                            document.getElementById('delete-batch-form-{{ $role->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-batch-form-{{ $role->id }}" action="{{ route('batch.destroy',$role->id) }}" method="POST" style="display:none;">
                                        @method('DELETE')
                                        @csrf

                                    </form> --}}
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $roles->links() }}
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
