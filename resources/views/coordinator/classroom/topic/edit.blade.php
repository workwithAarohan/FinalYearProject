@extends('layouts.nav')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6 border bg-white p-0">
                <h4 class="bg-primary text-white p-2">Edit Topic</h4>
                <form action="{{ route('topic.update', $topic->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class=" p-3">
                        <label for="" class="form-label">Topic Title</label>
                        <input type="text" name="topic_title" class="form-control" value="{{ $topic->topic_title }}">
                    </div>

                    <div class=" p-3">
                        <label for="" class="form-label">Classroom</label>
                        <input type="text" value="{{ $topic->classroom->room_name }}" class="form-control" disabled>
                        <input type="hidden" name="classroom_id" value="{{ $topic->classroom_id }}">
                    </div>

                    <div class=" p-3">
                        <label for="credit_hr" class="form-label">Credit Hours</label>
                        <input type="text" name="credit_hrs" class="form-control" value="{{ $topic->credit_hrs }}">
                    </div>

                    <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

                    <div class="p-3">
                        <button type="submit" class="btn btn-primary form-control text-white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
