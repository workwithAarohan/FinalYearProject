<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Batch</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th 
        {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) 
        {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <table style=" width: 50%;">
        <tr>
            <th> Book Name</th>
            <th> Author name</th>
            <th>publication</th>
            <th>action</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>
                    <a href="{{ route('book.show',$book->id) }}">
                        {{ $book->book_name }}
                    </a>
                </td>
                <td>
                    
                        {!! $book->author_name !!}
                   
                </td>
                <td>
                    
                        {{ $book->publication }}
                  
                </td>
                <td style="display: flex; align: center;">
                    <a href="{{ route('book.edit', $book->id) }}">Edit</a>
                    &emsp;
                    <form action="{{ route('book.destroy', $book->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br><br>
    <a href="{{ route('book.create') }}">Create New book</a>

    
</body>
</html>