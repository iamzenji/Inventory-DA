@extends('layouts.app')
@section('content')
<script>

    $.ajax({
        url: "{{ route('hello.ajax') }}",
        type: "get",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log(response); // Output: Hello from backend!
        }
    });


</script>
@endsection