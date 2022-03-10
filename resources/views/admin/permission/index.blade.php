@extends('admin.dashboard')

@section('title')
    Permission - Index
@endsection

@section('style')
    tr[data-href]
    {
        cursor: pointer;
    }

    .permission-input:focus
    {
        outline: none;
    }

    .permission-input:focus + .permission-button
    {
        border: 2px solid #092bc5;
    }
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
                    Permissions
                </h1>

                <form action="{{ route('permission.store') }}" method="post" class="float-end d-flex">
                    @csrf
                    <div class="input-group mb-3" style="">
                        <input type="text" class="permission-input" placeholder="Add Permission"  name="name" style="background: #fff; width: 200px; height: 30px; border: 1px solid #bebdbd; padding: 8px; border-radius: 5px 0 0 5px;">
                        <button style="background: #092bc5; color: #fff; border: none; border-radius: 0 5px 5px 0; width: 80px;" type="submit" class="px-3 role-button">Add</button>
                      </div>
                </form>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Permission</th>
                        <th scope="col">No.of Users</th>
                        <th scope="col">Roles</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody id="permissions">
                    <?php $i=1;  ?>
                    @foreach ($permissions as $permission)
                        <tr data-href="{{ route('permission.show',$permission->id) }}">
                            <th scope="row">
                                {{ $i }}
                            </th>
                            <th scope="row">
                                {{ $permission->name }}
                            </th>
                            <td>
                                {{ $permission->users->count() }}
                            </td>
                            <td>
                                {{ $permission->roles->count() }}
                            </td>
                            @can('logged-in')
                                <td>
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('permission.edit',$permission->id) }}" class="me-3 text-decoration-none text-dark" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-dark" title="Delete" style="padding: 0px; border: none; background: transparent;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endcan
                        </tr>

                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>

            {{ $permissions->links() }}
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
