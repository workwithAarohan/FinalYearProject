@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 bg-white p-0">
                <form action="{{ route('course.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                    <h3 class="bg-primary text-white fs-4 text-center p-2">
                        Add New Course
                    </h3>
                    <div class="d-flex p-3 align-items-center">
                        <div class="me-3">
                            <label for="slug" class="form-label">Course Slug: </label>
                            <input type="text" name="slug"  class="form-control @error('slug') is-invalid @enderror">
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="w-75">
                            <label for="course_name" class="form-label">Course Name</label>
                            <input type="text" name="course_name" id="course_id" class="form-control @error('course_name') is-invalid @enderror">
                            @error('course_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="px-3 mb-3">
                        <label for="title" class="form-label">Course Title: </label>
                        <input type="text" name="title" style="width: 500px;" class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class=" px-3 mb-3">
                        <label for="image" class="form-label">Image </label>
                        <input type="file" name="image" style="width: 500px;" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class=" px-3 mb-3">
                        <label for="description" class="form-label">Description: </label> <br>
                        <textarea name="description" id="description" cols="50" rows="12" class="form-control @error('description') is-invalid @enderror">
                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="px-3 mb-3">
                        <label for="objective" class="form-label">Objective: </label> <br>
                        <textarea name="objective" id="objective" cols="50" rows="12" class="form-control @error('objective') is-invalid @enderror">
                        </textarea>
                        @error('objective')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 px-3">
                        <button type="submit" class="btn btn-primary ">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
