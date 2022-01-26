@extends('layouts.nav')

@section('style')
    <style>
        .form-input:focus
        {
            border: 5px solid red;
            outline: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-3">
        <div class="row justify-content-center" style="column-gap: 20px;">
            <div class="col-md-8 p-4 bg-white">
                <div class="d-flex">
                    <div class="icon" style="width: 60px;">
                        <i class="fas fa-clipboard-list fs-4" style="background: #3a7fdf; color: #fff; border-radius: 50%; padding: 10px;"></i>
                    </div>
                    <div class="assignment-details w-100">
                        <div class="d-flex justify-content-between w-100" style="">
                            <div class="info">
                                <h4 class=" fs-2" style="color: #0d3cac;">
                                    {{ $assignment->title }}
                                </h4>
                                <p style="margin-top: -10px; font-size: 13px;">
                                    {{ $assignment->createdBy->firstname }} {{ $assignment->createdBy->lastname }} <span>&#9679;</span>
                                    {{ $assignment->created_at->toFormattedDateString() }}
                                </p>
                            </div>
                            <div class="action">
                                <div class="dropdown">
                                    <button class="btn btn-default" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <li>
                                            <a href="{{ route('assignment.edit',$assignment->id) }}" class="me-3 text-decoration-none dropdown-item" title="Edit">
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST" class="dropdown-item">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="p-0 btn" title="Delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between w-100" style="margin-top: -15px; border-bottom: 1px solid #0078D4; font-size: 13px;">
                            <p class="fw-bold" >
                                {{ $assignment->points }} Points
                            </p>
                            <p class="fw-bold">Due {{ $assignment->due_date }} </p>
                        </div>

                        @if ($assignment->instruction)
                            <div class="instruction mt-3">
                                <p>{{ $assignment->instruction }}</p>
                                <hr>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="comment" style="margin-left: 60px;">
                    <div class="d-flex align-items-center">
                        <div class="icon me-2" style="font-size: 20px;">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h5 class="mt-2 fw-bold" style="font-size: 14px;">Class Comments ({{ $assignment->comments->count() }})</h5>
                    </div>
                    <div class="p-2">
                        @foreach ($assignment->comments as $comment)
                        <div class="d-flex align-items-top">
                            <div class="image me-3">
                                <img src="{{ asset('images/profile/'. $comment->createdBy->avatar) }}" style="width: 32px; border-radius: 50%;" class="">
                            </div>

                            <div class="comment-section">
                                <div class="user d-flex align-items-baseline">
                                    <a href="" class="me-3" style="text-decoration: none; font-weight: bold; color: #000; font-size: 13px;">{{ $comment->createdBy->firstname }} {{ $comment->createdBy->lastname }}</a>
                                    <p style="font-size: 12px;">
                                        {{ $comment->updated_at->toFormattedDateString() }} {{ date('h:i A', strtotime($comment->updated_at)) }}
                                    </p>
                                </div>
                                <p style="margin-top: -15px; font-size: 13px;">{{ $comment->comment }}</p>
                            </div>


                        </div>

                        @endforeach
                    </div>

                    <hr class="m-0">

                    <div class="d-flex mt-2">
                        <div class="image p-2">
                            <img src="{{ asset('images/profile/'. auth()->user()->avatar) }}" style="width: 40px; height: 40px; border-radius: 50%;" class="">
                        </div>

                        <form action="{{ route('comment.store') }}" method="POST" class="w-100 p-2" style="position: relative;">
                            @csrf

                            <input type="hidden" name="commentable_id" value="{{ $assignment->id }}">
                            <input type="hidden" name="commentable_type" value="App\Models\Assignment">
                            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">

                            <textarea name="comment" id="" cols="30" rows="10" class="px-4 form-input py-2" style="border-radius: 40px; border: 1px solid #c3c3c3; height: 40px; width: 100%; font-size: 14px; overflow: hidden; resize: none;" placeholder="Add comment..."></textarea>

                            <button style="background: transparent; border:none; position: absolute; top: 15px; right: 15px;" type="submit">
                                <svg focusable="false" width="30" height="24" viewBox="0 0 24 24" class=" NMm5M hhikbc"><path d="M2 3v18l20-9L2 3zm2 11l9-2-9-2V6.09L17.13 12 4 17.91V14z"></path></svg>
                            </button>
                        </form>
                    </div>




                </div>
            </div>

            <div class="col-md-3 bg-white p-2 text-center" style="height: 200px; position: relative;">
                <h4 class=" fs-2" style="color: #0d3cac; ">
                    Students Work
                </h4>

                <div class="d-flex justify-content-center mt-3">
                    <div class="checked me-3 text-center">
                        <h5 style="font-size: 40px;">
                            {{ $assignment->classroom->students->count() }}
                        </h5>
                        <p class="muted" style="font-size: 13px; margin-top: -10px;">Students</p>
                    </div>
                    <div class="vr me-3" style="height: 65px; width: 2px;"></div>
                    <div class="checked me-3 text-center">
                        <h5 style="font-size: 40px;">
                            {{ $assignment->student_points->where('pointsObtained','!=',null)->count() }}
                        </h5>
                        <p class="muted" style="font-size: 13px; margin-top: -10px;">Checked</p>
                    </div>
                    <div class="vr me-3" style="height: 65px; width: 2px;"></div>
                    <div class="returned text-center">
                        <h5 style="font-size: 40px;">
                            {{ $assignment->student_points->where('is_returned',1)->count() }}
                        </h5>
                        <p class="muted" style="font-size: 13px; margin-top: -10px;">Returned</p>
                    </div>
                </div>

                <a href="{{ route('studentWork.index', $assignment->id) }}" class="text-decoration-none fw-bold px-2 py-1" style="position: absolute; bottom: 15px; right: 10px; color: #0d3cac; border: 2px solid #0d3cac;">
                    View Work
                </a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("textarea").keyup(function(e) {
                while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
                    $(this).height($(this).height()+1);
                };
            });
        });
    </script>
@endsection
