<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <title>Welcome</title>
</head>
<body>
    <div class="container mt-4">

        @if ($admissionWindows->count>1)
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false">
                Admission Open For
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                    @foreach ($admissionWindows as $admissionWindow)
                        <li><a class="dropdown-item" href="{{ route('student.create', [$admissionWindow->course_id, $admissionWindow->batch_id]) }}">{{ $admissionWindow->course->courseDetails->slug }}</a></li>
                    @endforeach
                </ul>
            </div>
        @else
            @foreach ($admissionWindows as $admissionWindow)
                <a href="{{ route('student.create', [$admissionWindow->course_id, $admissionWindow->batch_id]) }}" class="btn btn-primary">
                    Admission Open for {{ $admissionWindow->course->courseDetails->slug }}
                </a>
            @endforeach
        @endif


          <br>



    </div>
</body>
</html>
