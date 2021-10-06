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
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($notifications->data['logo']) }}" class="img-thumbnail" alt="...">
                                </div>
                                <div class="col">
                                    <h4>{{ $notifications->data['title'] }}</h4>
                                    <a href="{{ route($notifications->data['route'],$notifications->data['id']) }}">{{ $notifications->data['message'] }}</a>
                                    <a href="{{ route('notification.markAsRead', $notifications->id) }}" class=" btn btn-secondary float-end w-25">
                                        Mark as Read
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="card p-3">
                    @foreach (auth()->user()->readNotifications as $notifications)
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($notifications->data['logo']) }}" class="border-0" style="width: 65px; height: auto; border-radius: 50% ">
                                </div>
                                <div class="col-md-9">
                                    <h5 class="font-weight-bold">{{ $notifications->data['title'] }}</h5>
                                    <a href="{{ route($notifications->data['route'],$notifications->data['id']) }}" class="text-decoration-none">
                                        {{ $notifications->data['message'] }}
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="{{ route('notification.markAsRead', $notifications->id) }}" class="text-decoration-none">
                                        <i class="fas fa-times fs-4 text-secondary"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
