@extends('layouts.nav')

@section('content')
    <div class="container mt-4">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-3 mb-2">
                    <div class="card-header">
                        New Notification
                    </div>
                    @foreach (auth()->user()->unreadNotifications as $notifications)
                        <div class="card-body">
                            <h4>{{ $notifications->data['title'] }}</h4>
                            <a href="{{ route($notifications->data['route'],$notifications->data['student_id']) }}">{{ $notifications->data['message'] }}</a>
                            <a href="{{ route('notification.markAsRead', $notifications->id) }}" class=" btn btn-secondary float-end w-25">
                                Mark as Read
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="card p-3">
                    @foreach (auth()->user()->readNotifications as $notifications)
                        <div class="card-body justify-content-between align-items-baseline">
                            <h4 class="text">{{ $notifications->data['title'] }}</h4>
                            <a href="{{ route($notifications->data['route'],$notifications->data['student_id']) }}">{{ $notifications->data['message'] }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection