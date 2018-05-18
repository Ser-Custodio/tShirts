<!doctype html>
<style>
    .centerSer{
        align-items: center;
        text-align: center;
    }
</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body class="centerSer">
<h1><b>CHECK YOUR SHIRT</b></h1><br>
<img src="{{route("fusion", [$shirt, $logo])}}" width="800px"><br><br>
<div class="row">
    <form class="col-md-offset-3 col-md-2" action="{{ route('saveImage',[$shirt,$logo]) }}" method="post">
        {{ csrf_field() }}
        {{ csrf_field() }}
        <input class="btn btn-lg btn-success" type="submit" value="Save">
    </form>
    <a class="col-md-2" href="{{route("imageEdit", [$shirt, $logo, $shirt->origineX])}}" class="col-md-4">
        <button class="btn btn-lg btn-primary"  value="Edit">Edit</button>
    </a>
    <a class="col-md-2" href="{{ route('deleteImage',$logo) }}">
        <button class="btn btn-lg btn-danger">Go Back</button>
    </a>
</div>
</body>
</html>
