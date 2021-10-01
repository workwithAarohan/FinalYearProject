@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row w-25">
            <form action="{{ route('batch.update',$batch->id) }}" method="POST">
                @method('PUT')
                @csrf
        
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Batch: 
                    </label>
        
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id='name' name="name" value="{{ $batch->name }}" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
        
        
                <button type="submit" class="btn btn-outline-primary">Update</button>
            </form>
        </div>
    </div>
@endsection