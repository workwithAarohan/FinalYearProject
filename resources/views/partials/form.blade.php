@extends('layouts.nav')

@section('style')
    <style>
        body{
            background: #F3F2F1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-group
        {

            align-items: baseline;
        }

        .form-label
        {
            width: 25px;
            font-size: 1.2rem;
            margin-right: 15px;
            font-weight: 1rem;
        }


        .form-input
        {
            border: none;
            border-radius: 3px;
            width: 100%;
            padding: 5px 10px;
            color: black;
        }

        .form-input:focus
        {
            outline: none;
            border-bottom: 2px solid #6264A7;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #6264A7;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #6264A7;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }


    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h5 class="fw-bold fs-3"><i class="fas fa-calendar-alt me-3"></i> New Event</h5>
            <p class="lead fs-5 mb-4">Add event to schedule a program</p>
        </div>
        <div class="row">
            <form action="">
                <div class="col-md-8">
                    <div class="mb-3 d-flex form-group">
                        <label for="title" class="form-label">
                            <i class="fas fa-pencil-alt"></i>
                        </label>
                        <input type="text" name="title" id="title" class="form-input" placeholder="Add Title">
                    </div>
                    <div class="mb-3 d-flex form-group ">
                        <label for="attendee" class="form-label">
                            <i class="fas fa-user-plus"></i>
                        </label>
                        <input type="text" name="attendee" id="attendee" class="form-input" placeholder="Add Required Attendee">
                    </div>
                    <div class="mb-3 d-flex form-group">
                        <label for="" class="form-label">
                            <i class="far fa-clock"></i>
                        </label>
                        <input type="date" name="startDate" id="" class="form-input me-2" style="width: 12rem;">

                        <label for="" class="form-label ms-2">
                            <i class="fas fa-arrow-right"></i>
                        </label>
                        <input type="date" name="startDate" id="" class="form-input me-2" style="width: 12rem;">


                        <label class="switch form-label">
                            <input type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>


                    <div class="mb-3 d-flex form-group">
                        <label for="venue" class="form-label">
                            <i class="fas fa-map-marker-alt"></i>
                        </label>
                        <input type="text" name="venue" id="venue" class="form-input" placeholder="Add Location">
                    </div>

                    <div class="mb-3 d-flex form-group">
                        <label for="venue" class="form-label">
                            <i class="fas fa-clipboard-list"></i>
                        </label>
                        <textarea name="description" id="description" cols="30" rows="100" class="form-input" placeholder="Type details for this new event" style>
                        </textarea>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
