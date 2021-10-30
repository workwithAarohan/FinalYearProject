<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('event.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title: </label>
        <input type="text" name='title' value="{{ $event->title }}"> <br> <br>
        <label for="description">Description: </label>
        <textarea name='description' id="" cols="30" rows="10"> {!! $event->description !!} </textarea> <br> <br>
        <label for="venue">Venue: </label>
        <input type="text" name='venue' value="{{ $event->venue }}"> <br> <br>
        <label for="date">Date: </label>
        <input type="date" name='date' value="{{ $event->date }}"> 
        
        <button type="Submit">Edit</button>
    </form>
</body>
</html>