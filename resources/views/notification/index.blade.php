@extends('layouts.nav')

@section('content')
    <div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-3">
                    <h4>Notification</h4>

                    @if (!auth()->user()->unreadNotifications->count())
                        <h5>No new Notification</h5>
                    @endif

                </div>

                @foreach (auth()->user()->unreadNotifications as $notifications)
                    <div class="card p-4">
                        <div class="d-flex mb-2">
                            <div class="image me-4">
                                <img src="{{ asset($notifications->data['logo']) }}" class="" style="width: 45px; height: 45px; border-radius: 50% ">
                            </div>
                            <div class="">
                                <h5 class="fw-bold m-0">{{ $notifications->data['title'] }}</h5>
                                <a href="{{ route($notifications->data['route'],$notifications->data['id']) }}" class="text-decoration-none text-black">
                                    {{ $notifications->data['message'] }}
                                </a>
                            </div>
                            <div class="lead fs-6 ms-3">
                                {{ $notifications->updated_at->toFormattedDateString() }}
                            </div>
                            <div class="" style="margin-left: auto">
                                <a href="{{ route('notification.markAsRead', $notifications->id) }}" class="btn btn-secondary">
                                    Mark as Read
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach (auth()->user()->readNotifications as $notifications)
                    <div class="card p-4 card-hover">
                        <div class="d-flex mb-2">
                            <div class="image me-4">
                                <img src="{{ asset($notifications->data['logo']) }}" class="" style="width: 45px; height: 45px; border-radius: 50% ">
                            </div>
                            <div class="">
                                <h5 class="fw-bold m-0">{{ $notifications->data['title'] }}</h5>
                                <a href="{{ route($notifications->data['route'],$notifications->data['id']) }}" class="text-decoration-none text-black">
                                    {{ $notifications->data['message'] }}
                                </a>
                            </div>
                            <div class="lead fs-6 ms-3">
                                {{ $notifications->updated_at->toFormattedDateString() }}
                            </div>
                            <div class="" style="margin-left: auto">
                                <a href="{{ route('notification.delete', $notifications->id) }}" class="text-decoration-none">
                                    <i class="fas fa-times fs-4 text-secondary"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
