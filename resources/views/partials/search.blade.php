@extends('layouts.nav')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <h3>Live Search for users</h3> <br>

                <input type="text" name="search" placeholder="Search user" class="form-control">

                <ul class="list-group" id="result">

                </ul>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            alert("All good.");
        });
        // $('body').on('keyup', '#search', function(){
        //     var searchField = $('#search').val();
        //         console.log(searchField);
        // });
        // $(document).ready(function() {
        //     $('#search').keyup(function(){
        //         $('#result').html('');

        //         var searchField = $('#search').val();
        //         console.log(searchField);

        //         // $.ajax({
        //         //     method: 'POST',
        //         //     url: '{{ route("search.users") }}',
        //         //     dataType: 'json',
        //         //     data: {
        //         //         '_token' : {{ csrf_token() }},
        //         //         searchField: searchField,
        //         //     },
        //         //     success: function(res){
        //         //         console.log(res);
        //         //     }
        //         // });

        //     });
        // });
    </script>
@endsection
