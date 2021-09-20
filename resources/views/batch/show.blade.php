<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    Batch: {{ $batch->name }} <br>

    <h4>Students list</h4>
    <ol>

        
        @foreach ($students as $value)

            @foreach ($value->users as $users)
                <li>{{ $users->firstname }}</li>
            @endforeach
        @endforeach
    </ol>
</body>
</html>