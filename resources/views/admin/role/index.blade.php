@extends('layouts.common')

@section('title')
    Role - Index
@endsection

@section('style')
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
                        <input type="text" class="role-input" placeholder="Add Role"  name="name" style="background: #fff; width: 200px; height: 30px; border: 1px solid #bebdbd; padding: 8px; border-radius: 5px 0 0 5px;">
                        <button style="background: #092bc5; color: #fff; border: none; border-radius: 0 5px 5px 0; width: 80px;" type="submit" class="px-3 role-button">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <div class="mb-3">
                        <form action="" class="">
                            <input type="text" id="search-roles" placeholder="Search" class="px-3 py-1" style="border: 1px solid #bebdbd; outline: none; width: 300px;">
                        </form>
                    </div>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">No.of Users</th>
                        <th scope="col">Permissions</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody id="roles">
                    <?php $i=1;  ?>
                    @foreach ($roles as $role)
                        <tr data-href="{{ route('role.show',$role->id) }}">
                            <th scope="row">
                                {{ $i }}
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
                            @role('Admin')
                                <td>
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('role.edit',$role->id) }}" class="me-3 text-decoration-none text-dark" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-dark" title="Delete" style="padding: 0px; border: none; background: transparent;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endrole
                        </tr>

                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>

            {{ $roles->links() }}
        </div>
    </div>

    <script>
        $('body').on('keyup', '#search-roles', function(){
            var search = $(this).val();

            $.ajax({
                method: 'POST',
                url: "{{ route('role.search') }}",
                dataType: 'json',
                data: {
                    '_token':  '{{ csrf_token() }}',
                    search: search
                },
                success: function(response){
                    var tableRow = '';
                    $('#roles').html('');

                    $.each(response, function(index, value){
                        index = index + 1;
                        console.log(value.students);
                        tableRow = '<tr><th scope="row">'+ index +'</th><th scope="row">'+ value.name +'</th><td>'+ value.students +'</td><td>'+ value.permissions +'</td><td><div class="d-flex align-items-baseline"><a href="" class="me-3 text-decoration-none text-dark" title="Edit"><i class="fas fa-edit"></i></a><form action="" method="POST">@method("DELETE")@csrf<button type="submit" class="text-dark btn" title="Delete" style="padding: 0px;"><i class="fas fa-trash"></i></button></form></div></td></tr>';

                        $('#roles').append(tableRow);
                    });
                }
            })
        });

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
