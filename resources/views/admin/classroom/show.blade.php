@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row ">
            <h4>{{ $classroom->room_name }}</h4>
            <h5>{{ $classroom->description }}</h5>
            <p>{{ $classroom->batch->batch_name }}</p>
            <p>{{ $classroom->subject->subject_name }}</p>
        </div>

        <div class="card shadow" style="padding: 10px 40px; ">
            <table class="table table-hover" style="font-size:small;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Topic</th>
                        <th scope="col">Credit Hrs</th>
                        <th scope="col">Remarks</th>
                        @can('logged-in')
                            <th scope="col">Action</th>
                        @endcan
                    </tr>
                </thead>

                <tbody>
                    <?PHP $i=1; ?>
                    @foreach ($classroom->topics as $topic)
                        <tr data-href="{{ route('classroom.show',$topic->id) }}">
                            <th scope="row">{{ $i }}</th>

                            <td>
                                {{ $topic->title }}
                                <ul>
                                    @foreach ($topic->subTopics as $subTopic)
                                        <li>{{ $subTopic->title }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="align-middle">
                                {{ $topic->credit_hrs }}
                            </td>
                            <td class="align-middle">
                                Assignments: {{ $topic->assignments->count() }}
                                <br> Notes: 0
                            </td>
                            @can('logged-in')
                                <td class="align-middle">
                                    <div class="d-flex align-items-baseline">
                                        <a href="{{ route('classroom.edit',$classroom->id) }}" class="me-3 text-decoration-none text-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('classroom.destroy', $classroom->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-danger p-0 btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endcan
                        </tr>

                        <?PHP  $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
