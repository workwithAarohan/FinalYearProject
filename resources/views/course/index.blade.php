<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course</title>
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
            <th>Course Name</th>
            <th>Action</th>
        </tr>
        @foreach ($courses as $course)
            <tr>
                <td>
                    <a href="{{ route('course.show',$course->id) }}">
                        {{ $course->name }}
                    </a>
                </td>
                <td style="display: flex; align: center;">
                    <a href="{{ route('course.edit', $course->id) }}">Edit</a>
                    &emsp;
                    <form action="{{ route('course.destroy', $course->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit"> Delete </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <br><br>
    <a href="{{ route('course.create') }}">Create New course</a>

    
</body>
</html>