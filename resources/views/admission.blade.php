<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Welcome</title>
</head>
<body>
    <div class="container mt-4">
        @foreach ($admissionWindows as $admissionWindow)
            @if ($admissionWindow->is_open)
                <a href="{{ route('student.create', [$admissionWindow->course_id, $admissionWindow->batch_id]) }}" class="btn btn-primary">
                    Admission Open for {{ $admissionWindow->course->courseDetails->slug }}
                </a>
            @endif
        @endforeach

    </div>
</body>
</html>
