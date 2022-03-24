@extends('layouts.common')

@section('title')
    Student Details
@endsection

@section('style')
        h5.background
        {
            font: 14px sans-serif;
            margin-top: 20px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            z-index: 1;
            font-weight: bold;
        }

        h5.background:before
        {
            border-top: 1px solid #ccc6c6;
            content:"";
            margin: 0 auto;
            position: absolute;
            top: 8px; left: 0; right: 0; bottom: 0;
            width: 95%;
            z-index: -1;
        }

        h5.background span
        {
            background: #ffffff;
            padding: 0 15px;
        }

        .bottom-element
        {
            position: absolute;
            bottom: 1px;
            border-top: 2px solid #382d2d;
        }
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col p-0 bg-white shadow">
                <h5 class="text-white text-center p-3 bg-primary" style="position: relative;">
                    Student Admission Information

                    @if ($admission->is_admitted)
                        <i class="fas fa-check shadow" style=" padding: 8px; border-radius: 50%; background: #04b13e; position: absolute; top: 10px; right: 20px;"></i>
                    @endif
                </h5>

                <h5 class="background">
                    <span>Personal Information</span>
                </h5>

                <div class="row p-4">
                    <div class="col-md-9 ">
                        <div class="mb-3 px-4">
                            <h4 class="fw-bold fs-5 m-1"> Student Name</h4>
                            <div class="d-flex">
                                <input type="text" class="form-control me-1" value="{{ $admission->firstname }}" disabled>
                                <input type="text" class="form-control" value="{{ $admission->lastname }}" disabled>
                            </div>
                        </div>
                        <div class="mb-3 px-4">
                            <h4 class="fw-bold fs-5 m-1"> Email </h4>
                            <input type="text" class="form-control" value="{{ $admission->email }}" disabled>
                        </div>
                        <div class="mb-3 px-4 ">
                            <h4 class="fw-bold fs-5 m-1 mb-2"> Address </h4>
                            <div class="d-flex">
                                <div class="w-50 me-1">
                                    <h5 class="fw-bold fs-6">
                                        Temporary Address
                                    </h5>
                                    <input type="text" class="form-control" value="{{ $admission->temporaryAddress }}" disabled>
                                </div>
                                <div class="w-50">
                                    <h5 class="fw-bold fs-6">
                                        Permanent Address
                                    </h5>
                                    <input type="text" class="form-control" value="{{ $admission->permanentAddress }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 px-4 ">
                            <div class="d-flex">
                                <div class="w-50 me-1">
                                    <h4 class="fw-bold fs-5 m-1"> Phone Number </h4>
                                <input type="text" class="form-control" value="{{ $admission->phone }}" disabled>
                                </div>
                                <div class="w-50">
                                    <h4 class="fw-bold fs-5 m-1"> Date of Birth </h4>
                                <input type="date" class="form-control" value="{{ $admission->dob}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 px-4 ">
                            <div class="d-flex">
                                <div class="w-50 me-1">
                                    <h4 class="fw-bold fs-5 m-1"> Gender </h4>
                                    <input type="text" class="form-control" value="{{ $admission->gender}}" disabled>

                                </div>
                                <div class="w-50">
                                    <h4 class="fw-bold fs-5 m-1"> Blood Group </h4>
                                    <input type="text" class="form-control" value="{{ $admission->blood_group}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 px-4">
                            <h4 class="fw-bold fs-5 m-1"> Nationality </h4>
                            <input type="text" class="form-control" value="{{ $admission->nationality }}" disabled>
                        </div>
                        <div class=" px-4 ">
                            <div class="d-flex">
                                <div class="w-50 me-1">
                                    <h4 class="fw-bold fs-5 m-1"> Father Name </h4>
                                    <input type="text" class="form-control" value="{{ $admission->father_name}}" disabled>

                                </div>
                                <div class="w-50">
                                    <h4 class="fw-bold fs-5 m-1"> Mother Name</h4>
                                    <input type="text" class="form-control" value="{{ $admission->mother_name}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <img src="{{ asset('images/profile/'.$admission->pp_photo) }}" class="" style="width: 140px; object-fit: cover; ">
                        </div>
                    </div>
                </div>

                <h5 class="background">
                    <span>Education</span>
                </h5>

                <div class="row p-4">
                    <div class="col-md-9 ">
                        <div class="d-flex mb-3">
                            <h4 class="fw-bold fs-6 m-1 w-25">Board</h4>
                            <h4 class="fw-bold fs-6 m-1 w-25">Passed Year</h4>
                            <h4 class="fw-bold fs-6 m-1 w-25">Symbol Number</h4>
                            <h4 class="fw-bold fs-6 m-1 w-25">Percentage</h4>
                        </div>

                        @foreach ($admission->admission_educations as $education)
                            <div class="d-flex mb-3">
                                <input type="text" class="form-control me-2" value="{{ $education->board}}" disabled>
                                <input type="text" class="form-control me-2" value="{{ $education->passed_year}}" disabled>
                                <input type="text" class="form-control me-2" value="{{ $education->symbol_number}}" disabled>
                                <input type="text" class="form-control me-2" value="{{ $education->percentage_cgpa}}%" disabled>
                            </div>
                        @endforeach
                    </div>
                </div>

                <h5 class="background">
                    <span>Certificates</span>
                </h5>
            </div>
        </div>
        <div class="row mt-3">
            <form action="{{ route('student.store') }}" method="POST">
                @csrf
                <input type="hidden" name="admission_id" value="{{ $admission->id }}">
                <input type="hidden" name="roles[]" value="1">
                @if ($admission->is_admitted)
                    <input type="submit" value="Approve" class="btn btn-primary w-100" disabled>
                @else
                    <input type="submit" value="Approve" class="btn btn-primary w-100" >
                @endif

            </form>
        </div>
    </div>
@endsection
