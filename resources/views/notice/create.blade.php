@extends('layouts.nav')

@section('style')
    <style>
        .form-control{
            outline:none;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <form action="{{ route('notice.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">
                            Title:
                        </label>

                        <input type="text" class="form-control @error('title') is-invalid @enderror" id='title' name="title" value="{{ old('title') }}" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            Description:
                        </label>

                        <textarea name="description" id="description" cols="30" rows="100" class="form-control @error('description') is-invalid @enderror"></textarea>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">
                            Date:
                        </label>

                        <input type="date" class="form-control @error('date') is-invalid @enderror" id='date' name="date" value="{{ old('date') }}">


                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-outline-primary">Create</button>
                </form>
            </div>
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
