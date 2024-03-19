<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>



</head>

<body class="">

    <h1 class="">Hello world</h1>

    <form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="image" type="file">
        <button>Submit</button>
    </form>

    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    @foreach ($images as $image)
        <img width="200" src="{{ asset('storage/img/' . $image->image) }}" alt="">
        <form action="{{ route('image.update', $image) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input name="image" type="file">
            <button>Update</button>
        </form>
        <form action="{{ route('image.delete', $image) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
        <hr>
        <hr>
        @endforeach
        {{-- link --}}
        <form action="{{ route("image.urlstore") }}" method="post">
            @csrf
            <input type="url" name="link" placeholder="paste link">
            <button>save</button>
        </form>
</body>

</html>
