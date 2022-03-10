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
                    {{ $role->name }} Role
                </h1>
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
                    @foreach ($role->users as $user)
                        {{ $user->firstname }}
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="row bg-white mt-4 p-4 shadow">
            <div class="d-flex justify-content-between mb-2 align-items-baseline">
                <h5>Permissions</h5>
                <button style="border: 2px solid #000; background: transparent; font-weight: bold;">Add Permission</button>
            </div>
            <hr>
            <div class="" style="">
                @foreach ($role->permissions as $permission)
                    <button  style="background: #014b26ec; padding: 3px 10px; border-radius: 20px ; color: #fff; font-size: 12px; cursor: pointer; border: none;" class="permission mb-2">
                        {{ $permission->name }} <span class="far fa-times-circle remove-permission ms-1" style="font-size: 13px;"></span>
                    </button>
                @endforeach
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




    </script>
@endsection
