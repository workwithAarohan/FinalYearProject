<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('book.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="book_name">Book Name: </label>
        <input type="text" name='book_name' value="{{ $book->book_name }}"> <br> <br>
        <label for="author_name">Author Name: </label>
        <textarea name='author_name' id="" cols="30" rows="10"> {!! $book->author_name !!} </textarea> <br> <br>
        <label for="publication">Publication: </label>
        <input type="text" name='publication' value="{{ $book->publication }}"> <br> <br>

        
        <button type="Submit">Edit</button>
    </form>
</body>
</html>