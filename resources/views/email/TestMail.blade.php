<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>{{ $details['title'] }}</h4>

    <p>{{ $details['body'] }}</p>

    <footer>
        Regards,
        {{ auth()->user()->firstname }}
    </footer>
</body>
</html>
