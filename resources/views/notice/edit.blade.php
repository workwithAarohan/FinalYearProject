<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('notice.update', $notice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title: </label>
        <input type="text" name='title' value="{{ $notice->title }}"> <br> <br>
        <label for="description">Description: </label>
        <textarea name='description' id="" cols="30" rows="10"> {!! $notice->description !!} </textarea> <br> <br>
        <label for="date">Date: </label>
        <input type="date" name='date' value="{{ $notice->date }}"> 
        
        <button type="Submit">Edit</button>
    </form>
</body>
</html>