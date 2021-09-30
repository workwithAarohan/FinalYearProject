@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row w-25">
            <form action="{{ route('batch.store') }}" method="POST">
                @csrf
        
                <div class="mb-3">
                    <label for="name" class="form-label">
                        Batch: 
                    </label>
        
                    <input type="text" class="form-control" id='name' name="name" value="{{ old('name') }}">
                    
                    @error('name')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    {{-- <span class="invalid-feedback">
                        @error('name')
                            <strong>{{ $message }}</strong>
                            
                        @enderror
                    </span> --}}
                </div>
        
        
                <button type="submit" class="btn btn-outline-primary">Create</button>
            </form>
        </div>
    </div>
@endsection