@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-7">
                <h4>{{ $semester->semester_name }}</h4>
                <p>{{ $semester->description }}</p>
            </div>
            <div class="col">
                <strong>Created By: </strong><h6>{{ $semester->createdBy->firstname }}</h6>
                <strong>Status: </strong>
                <i>
                    @if ($semester->is_active)
                        Active
                    @else
                        Not Active
                    @endif
                </i>
            </div>
        </div>
    </div>
@endsection
