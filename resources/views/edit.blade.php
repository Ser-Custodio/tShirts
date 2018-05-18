<!doctype html>
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
<style>
    .centerSer{
        align-items: center;
        text-align: center;
    }
</style>
<body class="centerSer">
<h1>Modify your shirt</h1>
<br>
<div class="row">
    <img src="{{route("fusionLogoModif", [$shirt, $logo, $origineX, $origineY, $largeur])}}" style="width: 800px; border: 3px solid blue; border-radius: 20px">
</div>
<br><br>
<div>
    <form method="post" action="{{route("modiflogo", [$shirt, $logo])}}">
        {{csrf_field()}}
        <label>Position X: </label><input type="number" name="originex" value="{{$origineX}}">
        <label>Position Y: </label><input type="number" name="originey" value="{{$origineY}}">
        <label>Taille: </label><input type="number" name="largeur" value="{{$largeur}}">

        <input type="submit" value="valider">

    </form>
</div>
<br><br>
<div class="row">
    <div class="col-md-offset-2 col-md-4">
        <form action="{{route("enregistrerImageModif", [$shirt, $logo, $origineX, $origineY, $largeur])}}" method="post">
            {{csrf_field()}}
            <input class="btn btn-success " type="submit" value="Save">
        </form>
    </div>
    <div class="col-md-4">
        <button class="btn btn-success">Go Back</button>
    </div>
</div>
</body>
</html>
