<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('course.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name: </label>
        <input type="text" name="name" value="{{ $course->name }}"> <br> <br>
        <label for="description">Description: </label>
        <textarea name="description" id="description" cols="30" rows="10">{{ $course->description }}
        </textarea> <br><br>

        <button type="submit">Edit</button>
    </form>
</body>
</html>
