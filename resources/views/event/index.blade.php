<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event</title>
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
            <th> Event Title</th>
           <!--  <th> Event description</th>
            <th> Event Venue</th>
            <th> Event Date</th> -->
            <th>Action</th>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>
                    <a href="{{ route('event.show',$event->id) }}">
                        {{ $event->title }}
                    </a>
                </td>
            
                <td style="display: flex; align: center;">
                    <a href="{{ route('event.edit', $event->id) }}">Edit</a>
                    &emsp;
                    <form action="{{ route('event.destroy', $event->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br><br>
    <a href="{{ route('event.create') }}">Create New event</a>

    
</body>
</html>