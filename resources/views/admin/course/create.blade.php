<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('course.store') }}" method="POST">
        @csrf
        <label for="name">
            Course Name:
        </label>
        <input type="text" name="name">

        <label for="description">Description: </label>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <button type="submit">Create</button>
    </form>
</body>
</html>
