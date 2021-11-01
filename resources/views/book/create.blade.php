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
                <form action="{{ route('book.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="book_name" class="form-label">
                            Book Name:
                        </label>

                        <input type="text" class="form-control @error('book_name') is-invalid @enderror" id='book_name' name="book_name" value="{{ old('book_name') }}" autofocus>

                        @error('book_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author_name" class="form-label">
                            Author name:
                        </label>

                        <textarea name="author_name" id="author_name" cols="5" rows="5" class="form-control @error('author_name') is-invalid @enderror"></textarea>

                        @error('author_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publication" class="form-label">
                            Publication:
                        </label>

                        <textarea name="publication" id="publication" cols="5" rows="5" class="form-control @error('publication') is-invalid @enderror"></textarea>

                        @error('publication')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                   <!--  <div class="mb-3">
                        <label for="date" class="form-label">
                            Date:
                        </label>

                        <input type="date" class="form-control @error('date') is-invalid @enderror" id='date' name="date" value="{{ old('date') }}">


                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> -->


                    <button type="submit" class="btn btn-outline-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#author_name' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
