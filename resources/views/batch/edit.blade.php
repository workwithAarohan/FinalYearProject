<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('batch.update', $batch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">
            Batch Name:
        </label>
        <input type="text" name="name" value="{{ $batch->name }}">

        <button type="submit">Submit</button>
    </form>
</body>
</html>