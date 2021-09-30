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
            <th> Batch Name</th>
            <th>Action</th>
        </tr>
        @foreach ($batches as $batch)
            <tr>
                <td>
                    <a href="{{ route('batch.show',$batch->id) }}">
                        {{ $batch->name }}
                    </a>
                </td>
                <td style="display: flex; align: center;">
                    <a href="{{ route('batch.edit', $batch->id) }}">Edit</a>
                    &emsp;
                    <form action="{{ route('batch.destroy', $batch->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br><br>
    <a href="{{ route('batch.create') }}">Create New batch</a>

    
</body>
</html>