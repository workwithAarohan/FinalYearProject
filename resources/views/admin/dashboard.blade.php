@extends('layouts.common')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="padding: 10px 12px; width: 12rem;">
                    <div class="d-flex align-items-baseline">
                        <div style="margin: auto 5px;">
                            <i class="fas fa-user-graduate me-1" style="font-size: 32px;"></i>
                        </div>
                        <div style="margin: 0px auto; text-align:center">
                            <p style=" color: #002a79; font-size:16px;" >Student</p>
                            <h5 style=" font-size:26px; margin-top: -14px;">5</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="padding: 10px 12px; width: 12rem;">
                    <div class="d-flex align-items-baseline">
                        <div style="margin: auto 5px;">
                            <i class="fas fa-user me-1" style="font-size: 32px;"></i>
                        </div>
                        <div style="margin: 0px auto; text-align:center">
                            <p style=" color: #002a79; font-size:16px;" >Staff</p>
                            <h5 style=" font-size:26px; margin-top: -14px;">20</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="padding: 10px 12px; width: 12rem;">
                    <div class="d-flex align-items-baseline">
                        <div style="margin: auto 5px;">
                            <i class="fas fa-university me-1" style="font-size: 32px;"></i>
                        </div>
                        <div style="margin: 0px auto; text-align:center">
                            <p style=" color: #002a79; font-size:16px;" >Course</p>
                            <h5 style=" font-size:26px; margin-top: -14px;">{{ $course }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="padding: 10px 12px; width: 12rem;">
                    <div class="d-flex align-items-baseline">
                        <div style="margin: auto 5px;">
                            <i class="fas fa-users-class me-1" style="font-size: 32px;"></i>
                            <i class="fas fa-users me-1" style="font-size: 32px;"></i>
                        </div>
                        <div style="margin: 0px auto; text-align:center">
                            <p style=" color: #002a79; font-size:16px;" >Batch</p>
                            <h5 style=" font-size:26px; margin-top: -14px;">{{ $batch }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="padding: 10px 12px; width: 12rem;">
                    <div class="d-flex align-items-baseline">
                        <div style="margin: auto 5px;">
                            <i class="fas fa-id-badge me-1" style="font-size: 32px;"></i>
                        </div>
                        <div style="margin: 0px auto; text-align:center">
                            <p style=" color: #002a79; font-size:16px;" >Semester</p>
                            <h5 style=" font-size:26px; margin-top: -14px;">{{ $semester }}</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
