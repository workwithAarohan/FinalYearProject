<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notice</title>
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
            <th> Notice </th>
            <th> Description </th>
           <!--  <th> notice description</th>
            <th> notice Venue</th>
            <th> notice Date</th> -->
            <th>Action</th>
        </tr>
        @foreach ($notices as $notice)
            <tr>
                <td>
                    <a href="{{ route('notice.show',$notice->id) }}">
                        {{ $notice->title }}
                    </a>
                </td>

                <td>
                    <a href="{{ route('notice.show',$notice->id) }}">
                        {!! $notice->description !!}
                    </a>
                </td>

                <td style="display: flex; align: center;">
                    <a href="{{ route('notice.edit', $notice->id) }}">Edit</a>
                    &emsp;
                    <form action="{{ route('notice.destroy', $notice->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br><br>
    <a href="{{ route('notice.create') }}">Create New notice</a>


</body>
</html>
